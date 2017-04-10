ALTER TABLE `users` ADD `username` VARCHAR(15) NOT NULL ;
ALTER TABLE `users` ADD `password` INT NOT NULL ;
ALTER TABLE `users` CHANGE `password` `password` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;