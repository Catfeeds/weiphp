DELETE FROM `wp_attribute` WHERE `model_name`='TimeBank';
DELETE FROM `wp_model` WHERE `name`='TimeBank' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_TimeBank`;