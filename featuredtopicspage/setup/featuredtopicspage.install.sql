-- file featuredtopicspage.install.sql
CREATE TABLE IF NOT EXISTS `cot_featured_topics_page` (
  `fftp_id` int unsigned NOT NULL auto_increment,
  `fftp_from_id` int unsigned NOT NULL default '0',
  `fftp_to_id` int unsigned NOT NULL default '0',
  `fftp_order` tinyint unsigned NOT NULL default '0',
  PRIMARY KEY (`fftp_id`),
  UNIQUE KEY `unique_pair` (`fftp_from_id`,`fftp_to_id`),
  KEY `idx_from` (`fftp_from_id`),
  KEY `idx_to` (`fftp_to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;