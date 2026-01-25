<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=page.tags
 * Tags=page.tpl:{FEATURED_FR_TOPIC_PAGE_TOPICS}
 * [END_COT_EXT]
 */
/**
 * featuredtopicspage.page.tags.php
 * Выводит блок рекомендуемых тем на странице статьи (шаблон page.tpl)
 * Поддерживает мультиязычность тем если есть плагин
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredtopicspage.page.tags.php
 *
 * Date: Jan 25Th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

global $db, $db_forum_topics, $db_x, $cfg, $id, $t, $structure;

require_once cot_incfile('featuredtopicspage', 'plug');

$article_id = (int)$id; // {PHP.article_id} = ID = `page_id` - карточка статьи

if ($article_id <= 0) {
    return;
}
// предел топиков на странице статьи
$max_items = (int)($cfg['plugin']['featuredtopicspage']['maxitems_page_rft'] ?? 5);
if ($max_items < 1) $max_items = 5;

$desc_len = (int)($cfg['plugin']['featuredtopicspage']['desc_length_page_rft'] ?? 160);
if ($desc_len < 40) $desc_len = 120;

$table_featured = $db_x . 'featured_topics_page';
// если пришел наш $article_id - то запрашиваем по нему у fftp_from_id что есть в fftp_to_id 
// fftp_from_id - это наша статья
// fftp_to_id  - это топик
$featured_topics = $db->query(
    "SELECT
        fftp.fftp_to_id AS id,
        f.ft_title,
        f.ft_desc,
        f.ft_cat,
        f.ft_preview,
        f.ft_postcount,
        f.ft_viewcount,
        f.ft_lastpostername,
        f.ft_updated
     FROM $table_featured fftp
     INNER JOIN $db_forum_topics f ON f.ft_id = fftp.fftp_to_id
     WHERE fftp.fftp_from_id = ?
       AND f.ft_state = 0
     ORDER BY fftp.fftp_order ASC
     LIMIT ?",
    [$article_id, $max_items]
)->fetchAll(PDO::FETCH_ASSOC);

if (empty($featured_topics)) {
    return;
}

// присваиваем шаблону имя части и/или локации расширения
$tpl_ExtCode          = 'featuredtopicspage';   // код плагина в составе имени шаблона
$tpl_PartExt          = 'page';                 // говорим, что это карточка статьи
$tpl_PartExtSecond    = 'topics';                 // говорим, что выводим топики

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
  $t = {FEATURED_FR_TOPIC_PAGE_TOPICS} которую вешаем на page.tags 
  и присваиваем как тег в шаблон page.tpl
 */

// $mskin = для нейминга шаблонов плагинов больше не используем имя переменной как $mskin 
// во избежание перезаписи $mskin, если наш шаблон это строка внутри другого шаблона со своим $m (mode)
$tt = new XTemplate($extTplFile);

foreach ($featured_topics as $item) {
    $item_id = (int)$item['id'];
	//устанавливаем булеевый флаг
	// его используем в условии 
	// <!-- IF {PHP|cot_plugin_active('featuredtopicspage')} AND {FEATURED_FR_TOPIC_PAGE_TOPICS_TRUE} -->
	// для того чтобы не грузить шаблон с версткой, но без данных
    $t->assign('FEATURED_FR_TOPIC_PAGE_TOPICS_TRUE', true);
    // 
    $url = cot_url('forums', "m=posts&q={$item_id}");
    $desc = !empty($item['ft_desc'])
        ? cot_string_truncate(strip_tags($item['ft_desc']), $desc_len, true, false)
        : cot_string_truncate(strip_tags($item['ft_preview'] ?? ''), $desc_len, true, false);
    $cat_code = $item['ft_cat'] ?? '';
    $cat_title = '';
    if (!empty($cat_code)) {
        $cat_title = !empty($structure['forums'][$cat_code]['title'])
            ? htmlspecialchars($structure['forums'][$cat_code]['title'], ENT_QUOTES, 'UTF-8')
            : htmlspecialchars($cat_code, ENT_QUOTES, 'UTF-8');
    }
    $main_image = get_featured_forum_topic_main_first_image($item_id);
    $tt->assign([
        'FEATURED_FR_TOPIC_PAGE_ROW_ID' => $item_id,	
        'FEATURED_FR_TOPIC_PAGE_ROW_URL' => htmlspecialchars($url, ENT_QUOTES, 'UTF-8'),
        'FEATURED_FR_TOPIC_PAGE_ROW_TITLE' => htmlspecialchars($item['ft_title'] ?? '', ENT_QUOTES, 'UTF-8'),
        'FEATURED_FR_TOPIC_PAGE_ROW_DESC' => htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'),
        'FEATURED_FR_TOPIC_PAGE_ROW_PREVIEW' => htmlspecialchars(cot_string_truncate(strip_tags($item['ft_preview'] ?? ''), $desc_len), ENT_QUOTES, 'UTF-8'),
        'FEATURED_FR_TOPIC_PAGE_ROW_CAT_TITLE' => $cat_title,
        'FEATURED_FR_TOPIC_PAGE_ROW_CAT_URL' => cot_url('forums', ['m' => 'topics', 's' => $cat_code]),
        'FEATURED_FR_TOPIC_PAGE_ROW_LINK_MAIN_IMAGE' => htmlspecialchars($main_image, ENT_QUOTES, 'UTF-8'),
        'FEATURED_FR_TOPIC_PAGE_ROW_POSTCOUNT' => $item['ft_postcount'],
        'FEATURED_FR_TOPIC_PAGE_ROW_VIEWCOUNT' => $item['ft_viewcount'],
        'FEATURED_FR_TOPIC_PAGE_ROW_LASTPOSTERNAME' => htmlspecialchars($item['ft_lastpostername'], ENT_QUOTES, 'UTF-8'),
        'FEATURED_FR_TOPIC_PAGE_ROW_UPDATED' => $item['ft_updated']
    ]);
	// Парсим одну строку в цикле и отдаем 
	//в MAIN цикла - (BEGIN: FEATURED_FR_TOPIC_PAGE_ROW и END: FEATURED_FR_TOPIC_PAGE_ROW) 
    $tt->parse('MAIN.FEATURED_FR_TOPIC_PAGE_ROW');
}
// Парсим основной блок шаблона $extTplFile
$tt->parse('MAIN');

// Присваиваем готовый HTML 
// в тег {FEATURED_FR_TOPIC_PAGE_TOPICS} 
// для родительского шаблона page.tpl
$t->assign('FEATURED_FR_TOPIC_PAGE_TOPICS', $tt->text('MAIN'));