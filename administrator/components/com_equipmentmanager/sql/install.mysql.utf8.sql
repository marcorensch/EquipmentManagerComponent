CREATE TABLE IF NOT EXISTS `#__equipmentmanager_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `checked_out_time` datetime,
  `checked_out` int(10) unsigned NOT NULL DEFAULT 0,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT 0,
  `language` char(7) NOT NULL DEFAULT '*',
  `publish_down` datetime,
  `publish_up` datetime,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `state` tinyint(3) NOT NULL DEFAULT 0,
  `catid` int(11) NOT NULL DEFAULT 0,
  `access` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_access` (`access`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_catid` (`catid`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_state` (`published`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_language` (`language`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_checkout` (`checked_out`);
