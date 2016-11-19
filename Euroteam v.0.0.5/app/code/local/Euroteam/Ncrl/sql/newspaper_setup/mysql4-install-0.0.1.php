<?php

$installer = $this;

$installer->startSetup();

$installer->run("

SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
SET time_zone = '+00:00';

DROP TABLE IF EXISTS `newspaper`;
CREATE TABLE `newspaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='list of newspapers';

DROP TABLE IF EXISTS `newspaper_release`;
CREATE TABLE `newspaper_release` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_newspaper` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `time_limit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_newspaper` (`id_newspaper`),
  CONSTRAINT `newspaper_release_ibfk_1` FOREIGN KEY (`id_newspaper`) REFERENCES `newspaper` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `newspaper_release_section`;
CREATE TABLE `newspaper_release_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_newspaper_release` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_newspaper_release` (`id_newspaper_release`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
");

$installer->endSetup();
