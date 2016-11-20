<?php

$installer = $this;

$installer->startSetup();

$installer->run("


ALTER TABLE `sales_flat_quote_item`
    ADD COLUMN ads_info TEXT DEFAULT NULL;
    
ALTER TABLE `sales_flat_order_item`
    ADD COLUMN ads_info TEXT DEFAULT NULL;
    


");

$installer->endSetup();
