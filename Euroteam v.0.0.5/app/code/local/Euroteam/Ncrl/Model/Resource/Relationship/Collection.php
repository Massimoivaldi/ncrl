<?php

class Euroteam_Ncrl_Model_Resource_Relationship_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct() {
        $this->_init('newspaper/relationship');
    }

}
