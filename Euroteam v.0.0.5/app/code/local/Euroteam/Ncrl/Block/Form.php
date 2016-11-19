<?php

class Euroteam_Ncrl_Block_Form extends Mage_Core_Block_Template
{
 
    protected function _construct()
    {
        parent::_construct();        
        
    }
    
    public function getNewspapers() {
        $collection = Mage::getModel('newspaper/newspaper')->getCollection()
                ->addFieldToFilter('status', Euroteam_Ncrl_Model_Source_Status::STATUS_ACTIVE);
        return $collection;
    }
    
    public function getRelationships() {
        $collection = Mage::getModel('newspaper/relationship')->getCollection();                
        return $collection;
    }
}