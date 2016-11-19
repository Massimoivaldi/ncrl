<?php

class Euroteam_Ncrl_Block_Adminhtml_Sectionmodel extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function _construct() {
        $this->_controller = 'adminhtml_sectionmodel';
        $this->_blockGroup = 'newspaper';
        $this->_headerText = Mage::helper('newspaper')->__('Manage Newspaper Release Section Model');
        parent::_construct();
    }

    public function __construct() {
        parent::__construct();
    }

}
