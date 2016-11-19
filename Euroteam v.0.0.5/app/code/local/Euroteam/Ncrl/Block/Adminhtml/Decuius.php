<?php

class Euroteam_Ncrl_Block_Adminhtml_Decuius extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function _construct() {
        $this->_controller = 'adminhtml_decuius';
        $this->_blockGroup = 'newspaper';
        $this->_headerText = Mage::helper('newspaper')->__('Decuius');
        parent::_construct();
    }

    public function __construct() {
        parent::__construct();
    }

}
