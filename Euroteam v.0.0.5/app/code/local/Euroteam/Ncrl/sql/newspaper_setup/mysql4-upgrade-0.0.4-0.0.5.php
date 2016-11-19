<?php

$installer = $this;

$installer->startSetup();

$installer->run("


ALTER TABLE `ncrl_model_field` 
    DROP INDEX `id_ncrl_model`;
    
ALTER TABLE `ncrl_model_field` 
    DROP COLUMN `id_ncrl_model`;

ALTER TABLE `ncrl_model_field`
    ADD COLUMN id_ncrl_model_style int(11) AFTER `id`;

ALTER TABLE `ncrl_model_field` ADD INDEX `id_ncrl_model_style` (`id_ncrl_model_style`);

");

$installer->endSetup();
