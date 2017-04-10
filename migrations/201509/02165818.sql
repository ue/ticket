ALTER TABLE `answers` ADD `user_id` INT NOT NULL AFTER `id`;
ALTER TABLE `questions` ADD `user_id` INT NOT NULL ;
