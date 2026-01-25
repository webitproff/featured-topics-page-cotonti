<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=page.delete.done
 * [END_COT_EXT]
 */
/**
 * featuredtopicspage.page.delete.done.php - Delete links on article delete
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredtopicspage.page.delete.done.php
 *
 * Date: Jan 25Th, 2026
 * @package featuredtopicspage
 * @version 2.7.8
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');
global $db, $db_featured_topics_page, $id;
if ($id > 0)
{
    $db->delete($db_featured_topics_page, "fftp_from_id = ? OR fftp_to_id = ?", [$id, $id]);
}