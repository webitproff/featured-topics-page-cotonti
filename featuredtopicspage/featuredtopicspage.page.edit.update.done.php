<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=page.edit.update.done
 * [END_COT_EXT]
 */
/**
 * featuredtopicspage.page.edit.update.done.php - Saving featured topics on article update
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredtopicspage.page.edit.update.done.php
 *
 * Date: Jan 25Th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');
global $db, $db_forum_topics, $db_x, $cfg, $id;
$article_id = (int)$id;
if ($article_id <= 0) {
    return;
}
$max_items = (int)($cfg['plugin']['featuredtopicspage']['maxitems_page_rft'] ?? 5);
if ($max_items < 1) $max_items = 5;
$db_featured_topics_page = $db_x . 'featured_topics_page';
$db->delete($db_featured_topics_page, "fftp_from_id = ?", [$article_id]);
$featured_topic_ids = cot_import('featured_topic_id', 'P', 'ARR');
if (!is_array($featured_topic_ids) || empty($featured_topic_ids)) {
    return;
}
$used = [];
$order = 0;
foreach ($featured_topic_ids as $index => $val) {
    $rel_id = (int)trim($val);
    if ($rel_id < 1 || $rel_id == $article_id || in_array($rel_id, $used)) {
        continue;
    }
    $exists = $db->query(
        "SELECT 1 FROM $db_forum_topics WHERE ft_id = ? AND ft_state = 0",
        [$rel_id]
    )->fetchColumn();
    if (!$exists) continue;
    $db->insert($db_featured_topics_page, [
        'fftp_from_id' => $article_id,
        'fftp_to_id' => $rel_id,
        'fftp_order' => $order++
    ]);
    $used[] = $rel_id;
    if ($order >= $max_items) break;
}