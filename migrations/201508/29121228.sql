ALTER TABLE `questions` DROP `status`;
ALTER TABLE `questions` DROP `title`;
ALTER TABLE `questions` ADD `title` VARCHAR(255) NOT NULL AFTER `category_id`;
ALTER TABLE `questions` ADD `responsed_at` DATETIME NULL DEFAULT NULL ;
