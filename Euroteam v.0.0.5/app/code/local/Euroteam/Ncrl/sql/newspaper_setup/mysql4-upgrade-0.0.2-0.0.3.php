<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS `ncrl_decuius`;
CREATE TABLE `ncrl_decuius` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ncrl_relationship`;
CREATE TABLE `ncrl_relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ncrl_main`;
CREATE TABLE `ncrl_main` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_decuius` int(11) NOT NULL,
  `id_ncrl_relationship` int(11) NOT NULL,
  `id_newspaper_release_section_model` int(11) NOT NULL,
  `total_price` decimal(6,2) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_order` (`id_order`),
  KEY `id_decuius` (`id_decuius`),
  KEY `id_ncrl_relationship` (`id_ncrl_relationship`),
  KEY `id_newspaper_release_section_model` (`id_newspaper_release_section_model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ncrl_main_detail`;
CREATE TABLE `ncrl_main_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ncrl_main` int(11) NOT NULL,
  `id_field` int(11) NOT NULL,
  `text` text NOT NULL,
  `count_words` int(11) NOT NULL,
  `field_price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ncrl_main` (`id_ncrl_main`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  
");

$installer->endSetup();
