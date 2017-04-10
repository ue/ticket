ALTER TABLE `answers` ADD `created_at` DATETIME NOT NULL ;
ALTER TABLE `answers` ADD `updated_at` DATETIME NOT NULL ;
ALTER TABLE `answers` ADD `read_at` DATETIME NOT NULL ;
ALTER TABLE `answers` CHANGE `root_id` `question_id` INT(11) NOT NULL;