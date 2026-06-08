-- Add is_locked column to users table
USE `shop_quan_ao`;

ALTER TABLE `users` ADD COLUMN `is_locked` TINYINT(1) DEFAULT 0 AFTER `role`;
