<?php

class Euroteam_Ncrl_Block_Adminhtml_Modelfield_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct($attributes = array()) {
        parent::__construct($attributes);
    }

    public function _construct() {
        $this->setId('newspaper_modelfield_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        parent::_construct();
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('newspaper/modelfield')->getCollection();
        $collection->getSelect()
                ->joinLeft(array('field' => 'ncrl_field'), "main_table.id_ncrl_field = field.id", array('field_name' => 'field.name'))
                ->joinLeft(array('style' => 'ncrl_model_style'), "main_table.id_ncrl_model_style = style.id", array('style_name' => 'style.name'));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('id', array(
            'header' => Mage::helper('newspaper')->__('ID'),
            'width' => '50px',
            'type' => 'text',
            'index' => 'id',
            'filter_index' => 'main_table.id',
        ));


        $this->addColumn('field_name', array(
            'header' => Mage::helper('newspaper')->__('Field'),
            'type' => 'text',
            'index' => 'field_name',
            'filter_index' => 'field.name',
        ));

        $this->addColumn('style_name', array(
            'header' => Mage::helper('newspaper')->__('Style'),
            'type' => 'text',
            'index' => 'style_name',
            'filter_index' => 'style.name',
        ));

        $this->addColumn('available', array(
            'header' => Mage::helper('newspaper')->__('Available'),
            'type' => 'text',
            'index' => 'available',
            'filter_index' => 'available',
        ));

//        $this->addColumn('style', array(
//            'header' => Mage::helper('newspaper')->__('CSS'),
//            'type' => 'text',
//            'index' => 'style',
//            'filter_index' => 'style',
//        ));

        $this->addColumn('mandatory', array(
            'header' => Mage::helper('newspaper')->__('Mandatory'),
            'type' => 'options',
            'index' => 'mandatory',
            'filter_index' => 'mandatory',
            'options' => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray()
        ));

        $this->addColumn('weight', array(
            'header' => Mage::helper('newspaper')->__('Weight'),
            'type' => 'text',
            'index' => 'weight',
            'filter_index' => 'weight',
        ));

        $this->addColumn('minimum_weight', array(
            'header' => Mage::helper('newspaper')->__('Minimum Weight'),
            'type' => 'minimum_weight',
            'index' => 'style',
            'filter_index' => 'minimum_weight',
        ));

        $this->addColumn('price', array(
            'header' => Mage::helper('newspaper')->__('Price'),
            'type' => 'text',
            'index' => 'price',
            'filter_index' => 'price',
        ));



        $this->addColumn('action', array(
            'header' => Mage::helper('newspaper')->__('Action'),
            'width' => '100px',
            'type' => 'action',
            'filter' => false,
            'actions' => array(
                array(
                    'caption' => Mage::helper('newspaper')->__('Edit'),
                    'url' => Mage::helper('adminhtml')->getUrl('adminhtml/ncrl_modelfield/edit', array('id' => '$id'))
                ),
            ),
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

}
