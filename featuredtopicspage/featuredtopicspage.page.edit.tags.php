<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=page.edit.tags
 * Tags=page.edit.tpl:{FEATURED_FR_TOPIC_PAGE_EDIT_TOPIC}
 * [END_COT_EXT]
 */
/**
 * featuredtopicspage.page.edit.tags.php
 * Вывод формы выбора рекомендуемых тем в форме редактирования статьи
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredtopicspage.page.edit.tags.php
 *
 * Date: Jan 25Th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

global $cfg, $L, $db, $db_forum_topics, $db_x, $t, $id;

$id = (int)$id;

// подключаем функции плагина, и в нем уже должен быть cot_langfile
require_once cot_incfile('featuredtopicspage', 'plug'); 

$max_items = (int)($cfg['plugin']['featuredtopicspage']['maxitems_page_rft'] ?? 5);
if ($max_items < 1) $max_items = 5;

$table_topics = $db_x . 'featured_topics_page';

// иницализация масива, что будем рекомендовать
$featured_topics = [];

    // админ может выбирать любые топики
if (Cot::$usr['isadmin']) {
    $featured_topics = $db->query(
        "SELECT fftp.fftp_order, fftp.fftp_to_id AS id, f.ft_title AS title
         FROM $table_topics fftp
         LEFT JOIN $db_forum_topics f ON f.ft_id = fftp.fftp_to_id
         WHERE fftp.fftp_from_id = ?
         ORDER BY fftp.fftp_order ASC
         LIMIT ?",
        [$id, $max_items]
    )->fetchAll(PDO::FETCH_ASSOC);
} else {
	// юзверь выбирает только свои топики
    $featured_topics = $db->query(
        "SELECT fftp.fftp_order, fftp.fftp_to_id AS id, f.ft_title AS title
         FROM $table_topics fftp
         LEFT JOIN $db_forum_topics f ON f.ft_id = fftp.fftp_to_id
         WHERE fftp.fftp_from_id = ? AND f.ft_firstposterid = ?
         ORDER BY fftp.fftp_order ASC
         LIMIT ?",
        [$id, Cot::$usr['id'], $max_items]
    )->fetchAll(PDO::FETCH_ASSOC);
}

// присваиваем шаблону имя части и/или локации расширения
$tpl_ExtCode          = 'featuredtopicspage';   // код плагина
$tpl_PartExt          = 'edit';                   // область редактирования
$tpl_PartExtSecond    = 'topics';                 // что редактируем


// Загружаем шаблон 
$extTplFile = cot_tplfile(
		[
		$tpl_ExtCode, 
		$tpl_PartExt, 
		$tpl_PartExtSecond
		], 
		'plug', 
		true
	);

/* 	
  Создаём объект шаблона XTemplate с указанным файлом шаблона в $extTplFile выше
  объявляем как $tt, потому что будем встраивать наш шаблон $tt в строку $t 
  $t = {FEATURED_FR_TOPIC_PAGE_EDIT_TOPIC} которую вешаем на page.edit.tags 
  и присваиваем как тег в шаблон page.edit.tpl
 */

// $mskin = для нейминга шаблонов плагинов больше не используем имя переменной как $mskin 
// во избежание перезаписи $mskin, если наш шаблон это строка внутри другого шаблона со своим $m (mode)
$tt = new XTemplate($extTplFile);

// Цикл и поиск топикс для назначения рекомендуемыми
// Заполняем строки шаблона существующими темами на форуме
for ($i = 0; $i < $max_items; $i++) {
    $item = $featured_topics[$i] ?? ['id' => 0, 'title' => ''];
    $tt->assign([
        'FEATURED_FR_TOPIC_PAGE_NUM' => $i + 1,
        'FEATURED_FR_TOPIC_PAGE_INDEX' => $i,
        'FEATURED_FR_TOPIC_PAGE_TO_ID' => (int)$item['id'],
        'FEATURED_FR_TOPIC_PAGE_TO_TITLE' => htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8')
    ]);
	
    $tt->parse('MAIN.FEATURED_FR_TOPIC_PAGE_ROW');
}

// Парсим основной блок шаблона $extTplFile
$tt->parse('MAIN');
// Присваиваем готовый HTML 
// в тег {FEATURED_FR_TOPIC_PAGE_EDIT_TOPIC} 
// для родительского шаблона page.edit.tpl
$t->assign('FEATURED_FR_TOPIC_PAGE_EDIT_TOPIC', $tt->text('MAIN'));


Resources::linkFileFooter(Resources::SELECT2);

$ajaxUrl = cot_url('plug', [
    'r' => 'featuredtopicspage',
    'ajax' => 'search',
    'current_topic_id' => $id,
    'current_user_id' => Cot::$usr['id']
], '', true);

$placeholder = addslashes($L['featuredtopicspage_selecttopic_hint'] ?? 'Select Topic');
Resources::embedFooter(<<<JS
document.addEventListener('DOMContentLoaded', function () {
    $('.customrelated-select-topics').each(function () {
        if (this.dataset.inited) return;
        this.dataset.inited = true;
        const select = $(this);
        const hidden = select.closest('.customrelated-row').find('.customrelated-id');
        select.select2({
            ajax: {
                url: '{$ajaxUrl}',
                dataType: 'json',
                delay: 300,
                data: params => ({ qq: params.term || '' }),
                processResults: data => ({ results: data.results || [] }),
                cache: true
            },
            minimumInputLength: 2,
            width: '100%',
            placeholder: '{$placeholder}',
            allowClear: true,
            tags: false
        });
        const syncValue = () => {
            hidden.val(select.val() || '');
        };
        select.on('change', syncValue);
        select.on('select2:select select2:unselect', syncValue);
        const preselectedId = hidden.val();
        if (preselectedId && parseInt(preselectedId) > 0) {
            let text = select.find('option[value="' + preselectedId + '"]').text();
            if (!text) text = 'Тема #' + preselectedId;
            const option = new Option(text, preselectedId, true, true);
            select.append(option).trigger('change');
        }
    });
});
JS
);