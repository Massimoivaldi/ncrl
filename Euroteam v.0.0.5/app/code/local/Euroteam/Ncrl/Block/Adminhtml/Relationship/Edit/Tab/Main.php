<?php

class Euroteam_Ncrl_Block_Adminhtml_Relationship_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('newspaper_form_main', array('legend' => Mage::helper('newspaper')->__('Relationship Detail')));
        $model = Mage::registry('relationship_data');


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
        
        $fieldset->addField('rank', 'text', array(
            'label' => Mage::helper('newspaper')->__('Rank'),
            'name' => 'rank',
            'required' => true,
            'class' => ' validate-number'
        ));

        $formData = $form->getData();
        $form->addValues($form->getData());
        if (Mage::getSingleton('adminhtml/session')->getRelationshipData()) {
            $formData = Mage::getSingleton('adminhtml/session')->getRelationshipData();
            Mage::getSingleton('adminhtml/session')->setRelationshipData(null);
        } elseif (Mage::registry('relationship_data')) {
            $formData = Mage::registry('relationship_data')->getData();
            $form->addValues(Mage::registry('relationship_data')->getData());
        }
        $form->addValues($formData);

        return parent::_prepareForm();
    }

}
