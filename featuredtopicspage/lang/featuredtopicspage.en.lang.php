<?php
/**
 * featuredtopicspage.en.lang.php - English language file for Featured and Recommended Forum Topics in Article Item plugin
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredtopicspage/lang/featuredtopicspage.en.lang.php
 *
 * Date: Jan 25th, 2026
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
$L['cfg_maxitems_page_rft'] = 'Number of recommended topics';
$L['cfg_maxitems_page_rft_hint'] = 'Maximum number of topics that can be attached to an article as recommended. Displayed in the article edit form and on the article page.';

$L['cfg_max_select_itemslist_page_rft'] = 'Topics in dropdown list';
$L['cfg_max_select_itemslist_page_rft_hint'] = 'Number of items shown in the topic search dropdown when editing an article.';

$L['cfg_desc_length_page_rft'] = 'Description text length';
$L['cfg_desc_length_page_rft_hint'] = 'Maximum number of characters of the topic description shown in the recommended topics list on the article page.';

$L['cfg_nonimage_page_rft'] = 'Placeholder image';
$L['cfg_nonimage_page_rft_hint'] = 'Used when a topic has no image. <br>Path is relative to site root, e.g.: <code>plugins/featuredtopicspage/img/image.webp</code> (no domain, no leading slash)';

/**
 * Plugin Info
 */
$L['info_name'] = 'Recommended Forum Topics in Articles';
$L['info_desc'] = 'Allows attaching recommended forum topics to articles and displaying them on the article page.';
$L['info_notes'] = 'Requires Cotonti 0.9.26+ with <code>Resources::SELECT2</code>';

/**
 * Admin panel strings (used in plugin setup)
 */
$L['featuredtopicspage_title'] = $L['info_name']; // Plugin name in admin area
$L['featuredtopicspage_desc'] = $L['info_desc'];  // Plugin description in admin area

/**
 * Frontend strings (public part of the site)
 */
$L['featuredtopicspage_page_title'] = 'Recommended forum topics for this article';
$L['featuredtopicspage_edit_title'] = 'Recommended forum topics for this article';

$L['featuredtopicspage_add'] = 'Add another topic';
$L['featuredtopicspage_maxreached'] = 'Maximum number of recommended topics reached';

$L['featuredtopicspage_item_number'] = 'Recommended topic #';

$L['featuredtopicspage_selecttopic_hint'] = 'Start typing the topic title';
$L['featuredtopicspage_min_search'] = 'Enter at least 2 characters to search topics';