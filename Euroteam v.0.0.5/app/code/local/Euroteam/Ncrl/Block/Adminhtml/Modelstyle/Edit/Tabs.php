<?php

class Euroteam_Ncrl_Block_Adminhtml_Modelstyle_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct() {
        parent::__construct();
        $this->setId('newspaper_modelstyle_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('newspaper')->__('Model Style Detail'));
    }

    protected function _beforeToHtml() {
        $this->addTab('main_modelstyle', array(
            'label' => Mage::helper('newspaper')->__('Main'),
            'title' => Mage::helper('newspaper')->__('Main'),
            'content' => $this->getLayout()->createBlock('newspaper/adminhtml_modelstyle_edit_tab_main')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
