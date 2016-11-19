<?php

class Euroteam_Ncrl_Block_Adminhtml_Field_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Field Detail')));
        $model = Mage::registry('field_data');


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

        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getFieldData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getFieldData();
            Mage::getSingleton('adminhtml/session')->setFieldData(null);
        } elseif (Mage::registry('field_data')) {
            $formData = Mage::registry('field_data')->getData();
            $form->addValues(Mage::registry('field_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
