<?php

class Euroteam_Ncrl_Block_Adminhtml_Modelstyle extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function _construct() {
        $this->_controller = 'adminhtml_modelstyle';
        $this->_blockGroup = 'newspaper';
        $this->_headerText = Mage::helper('newspaper')->__('Manage Model Styles');
        parent::_construct();
    }

    public function __construct() {
        parent::__construct();
    }

}
