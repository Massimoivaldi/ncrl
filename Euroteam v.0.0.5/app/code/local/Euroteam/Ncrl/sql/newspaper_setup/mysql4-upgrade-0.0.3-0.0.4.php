<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS `ncrl_model_style`;
CREATE TABLE `ncrl_model_style` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ncrl_model` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
