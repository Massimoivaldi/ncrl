<?php

class Euroteam_Ncrl_Block_Adminhtml_Model_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $modelset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Model Detail')));
        $model = Mage::registry('model_data');


        if ($model && $model->getId()) {
            $modelset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $modelset->addField('name', 'text', array(
            'label' => Mage::helper('newspaper')->__('Name'),
            'name' => 'name',
            'required' => true,
        ));

        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getModelData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getModelData();
            Mage::getSingleton('adminhtml/session')->setModelData(null);
        } elseif (Mage::registry('model_data')) {
            $formData = Mage::registry('model_data')->getData();
            $form->addValues(Mage::registry('model_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
