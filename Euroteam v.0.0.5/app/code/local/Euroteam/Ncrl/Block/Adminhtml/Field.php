<?php

class Euroteam_Ncrl_Block_Adminhtml_Field extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function _construct() {
        $this->_controller = 'adminhtml_field';
        $this->_blockGroup = 'newspaper';
        $this->_headerText = Mage::helper('newspaper')->__('Manage Fields');
        parent::_construct();
    }

    public function __construct() {
        parent::__construct();
    }

}
