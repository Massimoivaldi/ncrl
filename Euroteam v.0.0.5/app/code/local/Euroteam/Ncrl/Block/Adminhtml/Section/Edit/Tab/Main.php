<?php

class Euroteam_Ncrl_Block_Adminhtml_Section_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Section Detail')));
        $model = Mage::registry('section_data');


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

        $release = Mage::getModel('newspaper/release')->getCollection();
        $releaseArray = array();
        foreach ($release as $item) {
            $releaseArray[$item->getId()] = $item->getName();
        }

        $fieldset->addField('id_newspaper_release', 'select', array(
            'label' => Mage::helper('newspaper')->__('Release'),
            'title' => Mage::helper('newspaper')->__('Release'),
            'name' => 'id_newspaper_release',
            'value' => '',
            'values' => $releaseArray
        ));



        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getSectionData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getSectionData();
            Mage::getSingleton('adminhtml/session')->setSectionData(null);
        } elseif (Mage::registry('section_data')) {
            $formData = Mage::registry('section_data')->getData();
            $form->addValues(Mage::registry('section_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
