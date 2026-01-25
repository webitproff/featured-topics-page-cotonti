<?php
/**
 * featuredtopicspage.ru.lang.php - Русский языковой файл для плагина Featured and Recommended Forum Topics in Article Item
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredtopicspage/lang/featuredtopicspage.ru.lang.php
 *
 * Date: Jan 25Th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');
/**
 * Plugin Config
 */
$L['cfg_maxitems_page_rft'] = 'Количество рекомендуемых тем';
$L['cfg_maxitems_page_rft_hint'] = 'Максимальное число тем, которые можно прикрепить к статье как рекомендуемые. Показываются в форме редактирования статьи и на странице статьи.';
$L['cfg_max_select_itemslist_page_rft'] = 'Тем в выпадающем списке';
$L['cfg_max_select_itemslist_page_rft_hint'] = 'Количество элементов, которые отображаются в выпадающем списке поиска тем при редактировании статьи.';
$L['cfg_desc_length_page_rft'] = 'Длина текста описания';
$L['cfg_desc_length_page_rft_hint'] = 'Максимальное количество символов описания темы, которое показывается в списке рекомендуемых тем на странице статьи.';
$L['cfg_nonimage_page_rft'] = 'Картинка-заглушка';
$L['cfg_nonimage_page_rft_hint'] = 'Если у темы нет изображения — используется эта заглушка. <br>Путь указывается относительно сайта, например: <code>plugins/featuredtopicspage/img/image.webp</code> (без домена и ведущих слешей)';
/**
 * Plugin Info
 */
$L['info_name'] = 'Рекомендуемые темы форума в статьях';
$L['info_desc'] = 'Позволяет прикреплять рекомендуемые темы форума к статье и показывать их на странице статьи.';
$L['info_notes'] = 'Требуется Cotonti 0.9.26+ с <code>Resources::SELECT2</code>';
/**
 * Admin panel strings (used in plugin setup)
 */
$L['featuredtopicspage_title'] = $L['info_name']; // Название плагина в админке
$L['featuredtopicspage_desc'] = $L['info_desc']; // Описание плагина в админке
/**
 * Frontend strings (публичная часть сайта)
 */
$L['featuredtopicspage_page_title'] = 'Рекомендуемые темы форума для этой статьи';
$L['featuredtopicspage_edit_title'] = 'Рекомендуемые темы форума для этой статьи';
$L['featuredtopicspage_add'] = 'Добавить ещё тему';
$L['featuredtopicspage_maxreached'] = 'Достигнут максимум рекомендуемых тем';
$L['featuredtopicspage_item_number'] = 'Рекомендуемая тема № ';
$L['featuredtopicspage_selecttopic_hint'] = 'Начните вводить название темы';
$L['featuredtopicspage_min_search'] = 'Введите минимум 2 символа для поиска тем';