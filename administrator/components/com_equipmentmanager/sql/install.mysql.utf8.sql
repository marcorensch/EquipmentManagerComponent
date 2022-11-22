CREATE TABLE IF NOT EXISTS `#__equipmentmanager_items` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL DEFAULT '',
    `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
    `catid` int(11) NOT NULL DEFAULT 0,
    `rental_price` varchar(100) DEFAULT '',
    `short_description` text NOT NULL,
    `description` text NOT NULL,
    `features` text NOT NULL,
    `gallery_path` varchar(255) NOT NULL DEFAULT '',
    `image` varchar(255) NOT NULL DEFAULT '',
    `ordering` int(11) NOT NULL DEFAULT 0,
    `checked_out` int(10) unsigned DEFAULT NULL,
    `checked_out_time` datetime,
    `language` char(7) NOT NULL DEFAULT '*',
    `state` tinyint(3) NOT NULL DEFAULT 0,
    `access` int(10) unsigned NOT NULL DEFAULT 0,
    `params` text NOT NULL,
    `published` tinyint(1) NOT NULL DEFAULT 0,
    `publish_down` datetime,
    `publish_up` datetime,
    `created` datetime,
    `created_by` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__equipmentmanager_packages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL DEFAULT '',
    `usage` varchar(255) NOT NULL DEFAULT '',
    `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
    `catid` int(11) NOT NULL DEFAULT 0,
    `rental_price_first` varchar(100) DEFAULT '',
    `rental_price_follow` varchar(100) DEFAULT '',
    `description` text NOT NULL,
    `related_items` text NOT NULL,
    `ordering` int(11) NOT NULL DEFAULT 0,
    `checked_out` int(10) unsigned DEFAULT NULL,
    `checked_out_time` datetime,
    `language` char(7) NOT NULL DEFAULT '*',
    `state` tinyint(3) NOT NULL DEFAULT 0,
    `access` int(10) unsigned NOT NULL DEFAULT 0,
    `params` text NOT NULL,
    `published` tinyint(1) NOT NULL DEFAULT 0,
    `publish_down` datetime,
    `publish_up` datetime,
    `created` datetime,
    `created_by` int(10) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_access` (`access`);
ALTER TABLE `#__equipmentmanager_packages` ADD KEY `idx_access_p` (`access`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_catid` (`catid`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_state` (`published`);
ALTER TABLE `#__equipmentmanager_packages` ADD KEY `idx_state_p` (`published`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_language` (`language`);
ALTER TABLE `#__equipmentmanager_packages` ADD KEY `idx_language_p` (`language`);

ALTER TABLE `#__equipmentmanager_items` ADD KEY `idx_checkout` (`checked_out`);
ALTER TABLE `#__equipmentmanager_packages` ADD KEY `idx_checkout_p` (`checked_out`);
