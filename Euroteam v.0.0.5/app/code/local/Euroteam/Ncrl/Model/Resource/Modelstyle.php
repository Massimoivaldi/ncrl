<?php

class Euroteam_Ncrl_Model_Resource_Modelstyle extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct() {
        $this->_init('newspaper/modelstyle', 'id');
    }

}
