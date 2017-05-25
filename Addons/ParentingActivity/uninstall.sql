DELETE FROM `wp_attribute` WHERE `model_name`='ParentingActivity';
DELETE FROM `wp_model` WHERE `name`='ParentingActivity' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_ParentingActivity`;


