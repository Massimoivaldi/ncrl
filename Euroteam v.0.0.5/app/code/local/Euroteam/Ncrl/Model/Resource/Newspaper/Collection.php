<?php

class Euroteam_Ncrl_Model_Resource_Newspaper_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct() {
        $this->_init('newspaper/newspaper');
    }

}
