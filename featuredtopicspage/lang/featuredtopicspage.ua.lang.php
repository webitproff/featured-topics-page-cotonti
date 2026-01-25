<?php
/**
 * featuredtopicspage.ua.lang.php - Український мовний файл для плагіна Рекомендовані теми форуму в статтях
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredtopicspage/lang/featuredtopicspage.ua.lang.php
 *
 * Date: Jan 25th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Неправильний URL');

/**
 * Налаштування плагіна
 */
$L['cfg_maxitems_page_rft'] = 'Кількість рекомендованих тем';
$L['cfg_maxitems_page_rft_hint'] = 'Максимальна кількість тем, які можна прикріпити до статті як рекомендовані. Відображаються у формі редагування статті та на сторінці статті.';

$L['cfg_max_select_itemslist_page_rft'] = 'Тем у випадаючому списку';
$L['cfg_max_select_itemslist_page_rft_hint'] = 'Кількість елементів, які показуються у випадаючому списку пошуку тем під час редагування статті.';

$L['cfg_desc_length_page_rft'] = 'Довжина тексту опису';
$L['cfg_desc_length_page_rft_hint'] = 'Максимальна кількість символів опису теми, що відображається у списку рекомендованих тем на сторінці статті.';

$L['cfg_nonimage_page_rft'] = 'Зображення-заглушка';
$L['cfg_nonimage_page_rft_hint'] = 'Використовується, якщо у теми немає зображення. <br>Шлях вказується відносно кореня сайту, наприклад: <code>plugins/featuredtopicspage/img/image.webp</code> (без домену та початкових слешів)';

/**
 * Інформація про плагін
 */
$L['info_name'] = 'Рекомендовані теми форуму в статтях';
$L['info_desc'] = 'Дозволяє прикріплювати рекомендовані теми форуму до статті та показувати їх на сторінці статті.';
$L['info_notes'] = 'Потрібен Cotonti 0.9.26+ з <code>Resources::SELECT2</code>';

/**
 * Рядки адмін-панелі (використовуються в налаштуваннях плагіна)
 */
$L['featuredtopicspage_title'] = $L['info_name']; // Назва плагіна в адмінці
$L['featuredtopicspage_desc'] = $L['info_desc'];  // Опис плагіна в адмінці

/**
 * Рядки фронтенду (публічна частина сайту)
 */
$L['featuredtopicspage_page_title'] = 'Рекомендовані теми форуму для цієї статті';
$L['featuredtopicspage_edit_title'] = 'Рекомендовані теми форуму для цієї статті';

$L['featuredtopicspage_add'] = 'Додати ще тему';
$L['featuredtopicspage_maxreached'] = 'Досягнуто максимум рекомендованих тем';

$L['featuredtopicspage_item_number'] = 'Рекомендована тема № ';

$L['featuredtopicspage_selecttopic_hint'] = 'Почніть вводити назву теми';
$L['featuredtopicspage_min_search'] = 'Введіть щонайменше 2 символи для пошуку тем';