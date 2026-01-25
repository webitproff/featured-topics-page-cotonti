<?php
/** 
 * featuredtopicspage.functions.php
 * featuredtopicspage plug for CMF Cotonti Siena v.0.9.26, PHP v.8.4+, MySQL v.8.0
 * Purpose: functions for the plugin featuredtopicspage
 * Notes: File for the Plugin Featured and Recommended Forum Topics in Article Item
 * Filename: featuredtopicspage.functions.php
 * @package featuredtopicspage
 * @version 2.7.8
 * @copyright (c) webitproff 2026 https://github.com/webitproff or https://abuyfile.com/users/webitproff
 * @license BSD
 */


defined('COT_CODE') or die('Wrong URL');

require_once cot_langfile('featuredtopicspage', 'plug');

/**
 * cleaning text .
 * @param string $text Input text
 * @return string
 */
function featuredtopicspage_descriptionText_cleaning(string $text): string
{
    if (empty($text)) {
        return '';
    }
	$tags_replace = [
	'<br>' => ' ',
	'</h1>' => ' ',
	'</h2>' => ' ',
	'</h3>' => ' ',
	'</h4>' => ' ',
	'</li>' => ' ',
	'<li>' => ' '
	];
	$text = strtr($text, $tags_replace);
		$text = strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
	$text = preg_replace('/[!?;:"\'\(\)\[\]{}<>\n\r\t]/u', ' ', $text);
		$text = preg_replace('/\s+/u', ' ', trim($text));
	return $text;
}



/**
 * Получает первое изображение, прикреплённое к теме форума.
 *
 * @param int $topic_id ID темы (ft_id в $db_forum_topics)
 * @return string Полный URL к изображению или к изображению-заглушке
 */
function get_featured_forum_topic_main_first_image(int $topic_id): string
{
    global $db, $db_forum_posts, $db_forum_topics, $cfg;
    if ($topic_id <= 0) {
        return $cfg['mainurl'] . '/plugins/featuredtopicspage/img/image.webp';
    }
    $default_image = !empty($cfg['plugin']['featuredtopicspage']['nonimage'])
		? rtrim($cfg['mainurl'], '/') . '/' . ltrim($cfg['plugin']['featuredtopicspage']['nonimage'], '/')
		: rtrim($cfg['mainurl'], '/') . '/plugins/featuredtopicspage/img/image.webp';
		
    // Находим первый пост темы
    $first_post_id = $db->query("SELECT fp_id FROM $db_forum_posts WHERE fp_topicid = ? ORDER BY fp_id ASC LIMIT 1", [$topic_id])->fetchColumn();
	
    if (!$first_post_id) {
        return $default_image;
    }
	
    if (cot_plugin_active('attacher')) {
        global $db_attacher;
        require_once cot_incfile('attacher', 'plug');
        $files_image = $db->query("SELECT * FROM $db_attacher WHERE att_area = 'forums' AND att_item = ? LIMIT 1", [$first_post_id])->fetch(PDO::FETCH_ASSOC);
        if ($files_image) {
            return $cfg['mainurl'] . '/' . $files_image['att_path'];
        }
    }
    return $default_image;
}
