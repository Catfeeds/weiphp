DELETE FROM `wp_attribute` WHERE `model_name`='study_math';
DELETE FROM `wp_model` WHERE `name`='study_math' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_study_math`;
DELETE FROM `wp_attribute` WHERE `model_name`='math_questions';
DELETE FROM `wp_model` WHERE `name`='math_questions' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_math_questions`;