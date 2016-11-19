<?php

class Euroteam_Ncrl_Block_Adminhtml_Decuius_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct() {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'newspaper';
        $this->_controller = 'adminhtml_decuius';

        $this->_updateButton('save', 'label', Mage::helper('newspaper')->__('Save'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "function saveAndContinueEdit(){ editForm.submit($('edit_form').action + 'back/edit') }";
    }

    public function getHeaderText() {
        if (Mage::registry('decuius_data') && Mage::registry('decuius_data')->getId()) {
            return Mage::helper('newspaper')->__("Edit Item %s", $this->htmlEscape(Mage::registry('decuius_data')->getId()));
        } else {
            return Mage::helper('newspaper')->__('Add Item');
        }
    }

}
