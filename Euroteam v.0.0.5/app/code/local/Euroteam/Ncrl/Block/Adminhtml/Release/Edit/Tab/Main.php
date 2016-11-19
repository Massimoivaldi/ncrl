<?php

class Euroteam_Ncrl_Block_Adminhtml_Release_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Release Detail')));
        $model = Mage::registry('release_data');


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

        $newspaper = Mage::getModel('newspaper/newspaper')->getCollection();
        $newspaperArray = array();
        foreach ($newspaper as $item) {
            $newspaperArray[$item->getId()] = $item->getName();
        }

        $fieldset->addField('id_newspaper', 'select', array(
            'label' => Mage::helper('newspaper')->__('Newspaper'),
            'title' => Mage::helper('newspaper')->__('Newspaper'),
            'name' => 'id_newspaper',
            'value' => '',
            'values' => $newspaperArray
        ));

        $fieldset->addField('frequency', 'text', array(
            'label' => Mage::helper('newspaper')->__('Frequency'),
            'name' => 'frequency',
            'required' => false,
        ));

        $fieldset->addField('time_limit', 'text', array(
            'label' => Mage::helper('newspaper')->__('Time Limit'),
            'name' => 'time_limit',
            'required' => false,
            'class' => 'validate-number'
        ));


        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getReleaseData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getReleaseData();
            Mage::getSingleton('adminhtml/session')->setReleaseData(null);
        } elseif (Mage::registry('release_data')) {
            $formData = Mage::registry('release_data')->getData();
            $form->addValues(Mage::registry('release_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
