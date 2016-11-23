<?php

class Euroteam_Ncrl_Block_Adminhtml_Decuius_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {        
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $decuiusset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Decuius Detail')));
        $model = Mage::registry('decuius_data');


        if ($model && $model->getId()) {
            $decuiusset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $decuiusset->addField('name', 'text', array(
            'label' => Mage::helper('newspaper')->__('Name'),
            'name' => 'name',
            'required' => true,
        ));
        
        $decuiusset->addField('surname', 'text', array(
            'label' => Mage::helper('newspaper')->__('Surname'),
            'name' => 'surname',
            'required' => true,
        ));
        
        $decuiusset->addField('created', 'date', array(
            'label' => Mage::helper('newspaper')->__('Date Created'),
            'name' => 'created',
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT), 
            'required' => true,
            'time' => false,
            'style' => 'min-width : 200px',
            'image'     =>    $this->getSkinUrl('images/grid-cal.gif')
        ));

        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getDecuiusData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getDecuiusData();
            Mage::getSingleton('adminhtml/session')->setDecuiusData(null);
        } elseif (Mage::registry('decuius_data')) {
            $formData = Mage::registry('decuius_data')->getData();
            $form->addValues(Mage::registry('decuius_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
