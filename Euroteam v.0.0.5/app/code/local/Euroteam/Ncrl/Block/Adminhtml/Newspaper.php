<?php

class Euroteam_Ncrl_Block_Adminhtml_Newspaper extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function _construct() {
        $this->_controller = 'adminhtml_newspaper';
        $this->_blockGroup = 'newspaper';
        $this->_headerText = Mage::helper('newspaper')->__('Manage Newspaper List');
        parent::_construct();
    }

}
