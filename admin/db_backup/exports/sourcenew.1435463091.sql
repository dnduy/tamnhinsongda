#----------------------------------------
# Backup Web Database 
# Version 1.0 by Gaconlonton  
# http://nina.vn  
# DATABASE:  sourcenew
# Date/Time:  Sunday 28th  June 2015 10:44:51
#----------------------------------------

DROP TABLE IF EXISTS table_photo;
CREATE TABLE `table_photo` (  `id` int(10) unsigned NOT NULL auto_increment,  `id_vitri` int(11) NOT NULL,  `photo` varchar(225) NOT NULL,  `ten` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,  `link` varchar(255) NOT NULL,  `mota` text NOT NULL,  `stt` int(10) unsigned NOT NULL default '1',  `hienthi` tinyint(1) NOT NULL default '1',  `com` varchar(30) NOT NULL,  PRIMARY KEY  (`id`)) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
INSERT INTO table_photo VALUES ('23','0','2022037794182350.jpg','sgfd','gdfg','','1','1','slider'), ('4','0','737.swf','','','','1','1','banner_top'), ('7','0','61910.swf','','','','1','1','banner_giua'), ('13','0','6407029.jpg','hình 1','','','1','1','banner_phai'), ('14','0','479560953958828.png','hình 2','','','1','1','doitac'), ('15','0','547171280500750.jpg','hình 3','','','1','1','doitac'), ('18','0','142759445620373.png','hình 4','','','1','1','doitac'), ('19','0','000216218941617.jpg','hình 5','','','1','1','doitac');
