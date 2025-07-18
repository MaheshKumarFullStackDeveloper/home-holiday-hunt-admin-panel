ALTER TABLE `news` ADD `story_id` BIGINT UNSIGNED NOT NULL AFTER `id`;

ALTER TABLE `news` ADD CONSTRAINT `stories_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `news`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `country_news` ADD CONSTRAINT `country_news_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users` ADD `user_type` ENUM('student','teaching_professional','parent','school') NULL DEFAULT NULL AFTER `password`;

ALTER TABLE `users` ADD `name` VARCHAR(255) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `users` ADD `school_name` VARCHAR(255) NULL DEFAULT NULL AFTER `name`;
ALTER TABLE `users` ADD `dob` DATE NULL DEFAULT NULL AFTER `phone_number`;