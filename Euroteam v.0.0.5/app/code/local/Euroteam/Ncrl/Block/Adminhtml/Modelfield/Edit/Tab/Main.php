<?php

class Euroteam_Ncrl_Block_Adminhtml_Modelfield_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Item Detail')));
        $model = Mage::registry('modelfield_data');


        if ($model && $model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }
        
        $fields = Mage::getModel('newspaper/field')->getCollection();
        $fieldArray = array();
        foreach ($fields as $item) {
            $fieldArray[$item->getId()] = $item->getName();
        }

        $fieldset->addField('id_ncrl_field', 'select', array(
            'label' => Mage::helper('newspaper')->__('Field'),
            'title' => Mage::helper('newspaper')->__('Field'),
            'name' => 'id_ncrl_field',
            'value' => '',
            'values' => $fieldArray,
            'required' => true,
            'class' => 'validate-select'
        ));
        
        $styles = Mage::getModel('newspaper/modelstyle')->getCollection();
        $styleArray = array();
        foreach ($styles as $item) {
            $styleArray[$item->getId()] = $item->getName();
        }

        $fieldset->addField('id_ncrl_model', 'select', array(
            'label' => Mage::helper('newspaper')->__('Style'),
            'title' => Mage::helper('newspaper')->__('Style'),
            'name' => 'id_ncrl_model_style',
            'value' => '',
            'values' => $styleArray,
            'required' => true,
            'class' => 'validate-select'
        ));
        
        
        $fieldset->addField('available', 'text', array(
            'label' => Mage::helper('newspaper')->__('Available'),
            'name' => 'available',
            'required' => true,
            'class' => 'validate-digits',            
        ));
        
        $fieldset->addField('style', 'textarea', array(
            'label' => Mage::helper('newspaper')->__('CSS'),
            'name' => 'style',
            'required' => true,
            'class' => 'required-entry'
        ));
        
        $fieldset->addField('mandatory', 'select', array(
            'label' => Mage::helper('newspaper')->__('Mandatory'),
            'name' => 'mandatory',
            'required' => true,
            'class' => 'validate-select',
            'values' => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray()
        ));
        
        $fieldset->addField('weight', 'text', array(
            'label' => Mage::helper('newspaper')->__('Weight'),
            'name' => 'weight',
            'required' => true,
            'class' => 'validate-number'
        ));
        
        $fieldset->addField('minimum_weight', 'text', array(
            'label' => Mage::helper('newspaper')->__('Minimum Weight'),
            'name' => 'minimum_weight',
            'required' => true,
            'class' => 'validate-number'
        ));
        
        $fieldset->addField('price', 'text', array(
            'label' => Mage::helper('newspaper')->__('Price'),
            'name' => 'price',
            'required' => true,
            'class' => 'validate-number'
        ));

        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getModelfieldData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getModelfieldData();
            Mage::getSingleton('adminhtml/session')->setModelfieldData(null);
        } elseif (Mage::registry('modelfield_data')) {
            $formData = Mage::registry('modelfield_data')->getData();
            $form->addValues(Mage::registry('modelfield_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
