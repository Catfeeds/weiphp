DELETE FROM `wp_attribute` WHERE `model_name`='time_bank';
DELETE FROM `wp_model` WHERE `name`='time_bank' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_time_bank`;