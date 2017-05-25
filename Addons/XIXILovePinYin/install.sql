CREATE TABLE IF NOT EXISTS `wp_XIXILovePinYin` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`pinyinname`  varchar(100) NULL  COMMENT '拼音',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`,`addon`) VALUES ('XIXILovePinYin','XIX爱拼音','0','','1','["pinyinname"]','1:基础','','','','','id:编号\r\npinyinname:拼音\r\nids:操作:[EDIT]|编辑,[DELETE]|删除,lists?target_id=[id]&target=_blank&_controller=Sn|成员管理,preview?id=[id]&target=_blank|预览','20','title','','1396061373','1447756274','1','MyISAM','XIXILovePinYin');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`model_name`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('pinyinname','拼音','varchar(100) NULL','string','','','1','','0','XIXILovePinYin','0','1','1422000992','1422000992','','3','','regex','','3','function');
UPDATE `wp_attribute` a, wp_model m SET a.model_id = m.id WHERE a.model_name=m.`name`;
