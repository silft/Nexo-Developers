/*Table structure for table `nexo_configs` */

DROP TABLE IF EXISTS `nexo_configs`;

CREATE TABLE `nexo_configs` (
  `option_id` bigint(20) NOT NULL,
  `option_name` varchar(64) NOT NULL,
  `option_value` longtext NOT NULL,
  `description` text,
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `nexo_configs` */

/*Table structure for table `nexo_custom_pages` */

DROP TABLE IF EXISTS `nexo_custom_pages`;

CREATE TABLE `nexo_custom_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `uri` varchar(128) NOT NULL,
  `special_content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `nexo_custom_pages` */

insert  into `nexo_custom_pages`(`id`,`title`,`content`,`uri`,`special_content`) values (1,'How to connect','This is the how to connect guide!...You can edit it from the admin panel','how_to_connect',NULL);

/*Table structure for table `nexo_news` */

DROP TABLE IF EXISTS `nexo_news`;

CREATE TABLE `nexo_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(128) NOT NULL,
  `date` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `nexo_news` */

insert  into `nexo_news`(`id`,`title`,`content`,`author`,`date`) values (1,'Testing','Sabeeeee<br />\r\nTesting 2','Drakantas','1338232758');
insert  into `nexo_news`(`id`,`title`,`content`,`author`,`date`) values (2,'Sabroso','I love your mum.','Drakantas','1338232759');

/*Table structure for table `nexo_news_comments` */

DROP TABLE IF EXISTS `nexo_news_comments`;

CREATE TABLE `nexo_news_comments` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `comment_id` varchar(128) NOT NULL DEFAULT 'main',
  `content` text,
  `author` varchar(128) NOT NULL,
  `date` int(12) NOT NULL,
  PRIMARY KEY (`id`,`news_id`,`author`,`comment_id`,`date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `nexo_news_comments` */

insert  into `nexo_news_comments`(`id`,`news_id`,`comment_id`,`content`,`author`,`date`) values (1,1,'main','Probando :) >_< <br />\r\nProblem? :troll: <br />\r\nProbando :) >_< <br />\r\nProblem? :troll: <br />\r\nProbando :) >_< <br />\r\nProblem? :troll:','Drakantas',1340027923);
insert  into `nexo_news_comments`(`id`,`news_id`,`comment_id`,`content`,`author`,`date`) values (2,1,'main','Problem? :lol:','drakantas',1340027925);

/*Table structure for table `nexo_realms` */

DROP TABLE IF EXISTS `nexo_realms`;

CREATE TABLE `nexo_realms` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `world_db` varchar(128) NOT NULL,
  `world_host` varchar(128) NOT NULL,
  `char_db` varchar(128) NOT NULL,
  `char_host` varchar(128) NOT NULL,
  PRIMARY KEY (`id`,`name`,`world_db`,`world_host`,`char_db`,`char_host`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `nexo_realms` */

insert  into `nexo_realms`(`id`,`name`,`world_db`,`world_host`,`char_db`,`char_host`) values (1,'Realm 1','world','127.0.0.1','characters','127.0.0.1');

/*Table structure for table `nexo_template` */

DROP TABLE IF EXISTS `nexo_template`;

CREATE TABLE `nexo_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `installed` int(3) NOT NULL DEFAULT '0',
  `active` int(3) NOT NULL DEFAULT '0',
  `wrapper` varchar(128) NOT NULL DEFAULT 'template',
  PRIMARY KEY (`id`,`wrapper`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `nexo_template` */

insert  into `nexo_template`(`id`,`name`,`installed`,`active`,`wrapper`) values (1,'grunged',1,1,'template');