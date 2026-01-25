<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=ajax
 * [END_COT_EXT]
 */
/**
 * featuredtopicspage.ajax.php - AJAX search for featured topics in page.edit.tpl
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredtopicspage.ajax.php
 *
 * Date: Jan 25Th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');
header('Content-Type: application/json; charset=UTF-8');
$qq = cot_import('qq', 'G', 'TXT');
$qq = trim($qq);
if (mb_strlen($qq) < 2) {
    echo json_encode(['results' => []]);
    exit;
}
$max_select_itemslist_page_rft = (int)($cfg['plugin']['featuredtopicspage']['max_select_itemslist_page_rft'] ?? 50);
$current_topic_id = cot_import('current_topic_id', 'G', 'INT');
$current_user_id = cot_import('current_user_id', 'G', 'INT');
global $db, $db_forum_topics;
$like = '%' . mb_strtolower($qq) . '%';
$where = "ft_state = 0 AND LOWER(ft_title) LIKE ?";
$params = [$like];
if ($current_topic_id > 0) {
    $where .= " AND ft_id != ?";
    $params[] = $current_topic_id;
}
if ($current_user_id > 0 && !Cot::$usr['isadmin']) {
    $where .= " AND ft_firstposterid = ?";
    $params[] = $current_user_id;
}
$rows = $db->query(
    "SELECT ft_id AS id, ft_title AS text
     FROM $db_forum_topics
     WHERE $where
     ORDER BY ft_updated DESC
     LIMIT $max_select_itemslist_page_rft",
    $params
)->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as &$row) {
    $row['id'] = (int)$row['id'];
    $row['text'] = (string)$row['text'];
}
echo json_encode(
    ['results' => $rows],
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);
exit;