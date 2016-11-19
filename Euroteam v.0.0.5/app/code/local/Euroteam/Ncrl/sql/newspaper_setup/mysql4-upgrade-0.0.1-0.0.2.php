<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS `ncrl_field`;
CREATE TABLE `ncrl_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ncrl_model`;
CREATE TABLE `ncrl_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ncrl_model_field`;
CREATE TABLE `ncrl_model_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ncrl_model` int(11) NOT NULL,
  `id_ncrl_field` int(11) NOT NULL,
  `available` tinyint(4) NOT NULL,
  `style` text NOT NULL,
  `mandatory` tinyint(4) NOT NULL,
  `weight` tinyint(4) NOT NULL,
  `minimum_weight` tinyint(4) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ncrl_model` (`id_ncrl_model`),
  KEY `id_ncrl_field` (`id_ncrl_field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `newspaper_release_section_model`;
CREATE TABLE `newspaper_release_section_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_newspaper_release_section` int(11) NOT NULL,
  `id_ncrl_model` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_newspaper_release_section` (`id_newspaper_release_section`),
  KEY `id_ncrl_model` (`id_ncrl_model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
");

$installer->endSetup();