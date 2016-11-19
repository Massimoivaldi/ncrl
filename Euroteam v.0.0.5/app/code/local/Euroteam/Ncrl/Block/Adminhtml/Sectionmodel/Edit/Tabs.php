<?php

class Euroteam_Ncrl_Block_Adminhtml_Sectionmodel_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct() {
        parent::__construct();
        $this->setId('newspaper_sectionmodel_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('newspaper')->__('Item Detail'));
    }

    protected function _beforeToHtml() {
        $this->addTab('main_sectionmodel', array(
            'label' => Mage::helper('newspaper')->__('Main'),
            'title' => Mage::helper('newspaper')->__('Main'),
            'content' => $this->getLayout()->createBlock('newspaper/adminhtml_sectionmodel_edit_tab_main')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}
