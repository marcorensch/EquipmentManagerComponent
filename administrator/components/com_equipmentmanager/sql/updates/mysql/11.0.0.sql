/** Placeholder File for the new version of the component. */

ALTER TABLE `#__equipmentmanager_items` ADD COLUMN `manufacturer` varchar(255) NOT NULL DEFAULT '';
ALTER TABLE `#__equipmentmanager_items` ADD COLUMN `ip65` tinyint(1) NOT NULL DEFAULT 0;
ALTER TABLE `#__equipmentmanager_items` ADD COLUMN `battery` tinyint(1) NOT NULL DEFAULT 0;