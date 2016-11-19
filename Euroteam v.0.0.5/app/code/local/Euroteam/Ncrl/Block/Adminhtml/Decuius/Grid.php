<?php

class Euroteam_Ncrl_Block_Adminhtml_Decuius_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct($attributes = array()) {
        parent::__construct($attributes);
    }

    public function _construct() {
        $this->setId('newspaper_decuius_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        parent::_construct();
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('newspaper/decuius')->getCollection();
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


        $this->addColumn('name', array(
            'header' => Mage::helper('newspaper')->__('Name'),
            'type' => 'text',
            'index' => 'name',
            'filter_index' => 'name',
        ));
        
        $this->addColumn('surname', array(
            'header' => Mage::helper('newspaper')->__('Surname'),
            'type' => 'text',
            'index' => 'surname',
            'filter_index' => 'surname',
        ));
        
        $this->addColumn('created', array(
            'header' => Mage::helper('newspaper')->__('Date Created'),
            'type' => 'datetime',
            'index' => 'created',
            'filter_index' => 'created',
        ));


        $this->addColumn('action', array(
            'header' => Mage::helper('newspaper')->__('Action'),
            'width' => '100px',
            'type' => 'action',
            'filter' => false,
            'actions' => array(
                array(
                    'caption' => Mage::helper('newspaper')->__('Edit'),
                    'url' => Mage::helper('adminhtml')->getUrl('adminhtml/ncrl_decuius/edit', array('id' => '$id'))
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
