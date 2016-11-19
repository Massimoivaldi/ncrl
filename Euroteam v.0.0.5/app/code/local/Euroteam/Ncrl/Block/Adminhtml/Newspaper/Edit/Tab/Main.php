<?php

class Euroteam_Ncrl_Block_Adminhtml_Newspaper_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Newspaper Detail')));
        $model = Mage::registry('newspaper_data');


        if ($model && $model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }


        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('newspaper')->__('Name'),
            'name' => 'name',
            'required' => true,
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('newspaper')->__('Status'),
            'title' => Mage::helper('newspaper')->__('Status'),
            'name' => 'status',
            'value' => '',
            'values' => Mage::getModel('newspaper/source_status')->toArray()
        ));

        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getNewspaperData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getNewspaperData();
            Mage::getSingleton('adminhtml/session')->setNewspaperData(null);
        } elseif (Mage::registry('newspaper_data')) {
            $formData = Mage::registry('newspaper_data')->getData();
            $form->addValues(Mage::registry('newspaper_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
