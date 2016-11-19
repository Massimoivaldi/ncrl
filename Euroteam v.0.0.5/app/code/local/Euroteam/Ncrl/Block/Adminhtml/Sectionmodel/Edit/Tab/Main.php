<?php

class Euroteam_Ncrl_Block_Adminhtml_Sectionmodel_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Item Detail')));
        $model = Mage::registry('sectionmodel_data');


        if ($model && $model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $section = Mage::getModel('newspaper/section')->getCollection();
        $sectionArray = array();
        foreach ($section as $item) {
            $sectionArray[$item->getId()] = $item->getName();
        }

        $fieldset->addField('id_newspaper_release_section', 'select', array(
            'label' => Mage::helper('newspaper')->__('Section'),
            'title' => Mage::helper('newspaper')->__('Section'),
            'name' => 'id_newspaper_release_section',
            'value' => '',
            'values' => $sectionArray
        ));
        
        
        $models = Mage::getModel('newspaper/model')->getCollection();
        $modelArray = array();
        foreach ($models as $item) {
            $modelArray[$item->getId()] = $item->getName();
        }

        $fieldset->addField('id_ncrl_model', 'select', array(
            'label' => Mage::helper('newspaper')->__('Model'),
            'title' => Mage::helper('newspaper')->__('Model'),
            'name' => 'id_ncrl_model',
            'value' => '',
            'values' => $modelArray
        ));



        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getSectionmodelData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getSectionmodelData();
            Mage::getSingleton('adminhtml/session')->setSectionmodelData(null);
        } elseif (Mage::registry('sectionmodel_data')) {
            $formData = Mage::registry('sectionmodel_data')->getData();
            $form->addValues(Mage::registry('sectionmodel_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
