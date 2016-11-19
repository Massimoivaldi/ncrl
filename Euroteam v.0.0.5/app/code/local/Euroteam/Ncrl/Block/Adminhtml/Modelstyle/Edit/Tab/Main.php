<?php

class Euroteam_Ncrl_Block_Adminhtml_Modelstyle_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Model Style Detail')));
        $model = Mage::registry('modelstyle_data');


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

        $modelModel = Mage::getModel('newspaper/model')->getCollection();
        $modelArray = array();
        foreach ($modelModel as $item) {
            $modelArray[$item->getId()] = $item->getName();
        }

        $fieldset->addField('id_ncrl_model', 'select', array(
            'label' => Mage::helper('newspaper')->__('Model'),
            'title' => Mage::helper('newspaper')->__('Model'),
            'name' => 'id_ncrl_model',
            'value' => '',
            'values' => $modelArray
        ));
        
         $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('newspaper')->__('Image'),
            'name' => 'image',
            'required' => true,
        ));



        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getModelstyleData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getModelstyleData();
            Mage::getSingleton('adminhtml/session')->setModelstyleData(null);
        } elseif (Mage::registry('modelstyle_data')) {
            $formData = Mage::registry('modelstyle_data')->getData();
            $form->addValues(Mage::registry('modelstyle_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
