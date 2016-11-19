<?php

class Euroteam_Ncrl_Block_Adminhtml_Sectionmodel_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct($attributes = array()) {
        parent::__construct($attributes);
    }

    public function _construct() {
        $this->setId('newspaper_sectionmodel_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        parent::_construct();
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('newspaper/sectionmodel')->getCollection();
        $collection->getSelect()
                ->joinLeft(array('section' => 'newspaper_release_section'), "main_table.id_newspaper_release_section = section.id", array('section_name' => 'section.name'))
                ->joinLeft(array('model' => 'ncrl_model'), "main_table.id_ncrl_model = model.id", array('model_name' => 'model.name'));
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

        $this->addColumn('section_name', array(
            'header' => Mage::helper('newspaper')->__('Release Section'),
            'type' => 'text',
            'index' => 'section_name',
            'filter_index' => 'section.name',
        ));
        
        
        $this->addColumn('model_name', array(
            'header' => Mage::helper('newspaper')->__('Model'),
            'type' => 'text',
            'index' => 'model_name',
            'filter_index' => 'model.name',
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('newspaper')->__('Action'),
            'width' => '100px',
            'type' => 'action',
            'filter' => false,
            'actions' => array(
                array(
                    'caption' => Mage::helper('newspaper')->__('Edit'),
                    'url' => Mage::helper('adminhtml')->getUrl('adminhtml/ncrl_sectionmodel/edit', array('id' => '$id'))
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
