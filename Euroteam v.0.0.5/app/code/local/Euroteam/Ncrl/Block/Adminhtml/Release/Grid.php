<?php

class Euroteam_Ncrl_Block_Adminhtml_Release_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct($attributes = array()) {
        parent::__construct($attributes);
    }

    public function _construct() {
        $this->setId('newspaper_release_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        parent::_construct();
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('newspaper/release')->getCollection();
        $collection->getSelect()
                ->joinLeft(array('list' => 'newspaper'), "main_table.id_newspaper= list.id", array('list_name' => 'list.name'));
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

        $this->addColumn('list_name', array(
            'header' => Mage::helper('newspaper')->__('Newspaper'),
            'type' => 'text',
            'index' => 'list_name',
            'filter_index' => 'list.name',
        ));

        $this->addColumn('frequency', array(
            'header' => Mage::helper('newspaper')->__('Frequency'),
            'type' => 'text',
            'index' => 'frequency',
            'filter_index' => 'frequency',
        ));

        $this->addColumn('time_limit', array(
            'header' => Mage::helper('newspaper')->__('Time Limit'),
            'type' => 'text',
            'index' => 'time_limit',
            'filter_index' => 'time_limit',
        ));


        $this->addColumn('action', array(
            'header' => Mage::helper('newspaper')->__('Action'),
            'width' => '100px',
            'type' => 'action',
            'filter' => false,
            'actions' => array(
                array(
                    'caption' => Mage::helper('newspaper')->__('Edit'),
                    'url' => Mage::helper('adminhtml')->getUrl('adminhtml/ncrl_release/edit', array('id' => '$id'))
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
