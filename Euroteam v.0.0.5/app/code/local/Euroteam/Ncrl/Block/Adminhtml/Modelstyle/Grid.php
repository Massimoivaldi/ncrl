<?php

class Euroteam_Ncrl_Block_Adminhtml_Modelstyle_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct($attributes = array()) {
        parent::__construct($attributes);
    }

    public function _construct() {
        $this->setId('newspaper_modelstyle_grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        parent::_construct();
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('newspaper/modelstyle')->getCollection();
        $collection->getSelect()
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


        $this->addColumn('name', array(
            'header' => Mage::helper('newspaper')->__('Name'),
            'type' => 'text',
            'index' => 'name',
            'filter_index' => 'name',
        ));

        $this->addColumn('model_name', array(
            'header' => Mage::helper('newspaper')->__('Model'),
            'type' => 'text',
            'index' => 'model_name',
            'filter_index' => 'model.name',
        ));
        
//        $this->addColumn('image', array(
//            'header' => Mage::helper('newspaper')->__('Image'),
//            'align' => 'left',
//            'index' => 'image',
//            'width'     => '100',
//            'renderer' => 'Euroteam_Ncrl_Block_Adminhtml_Template_Grid_Renderer_Image'
//        ));
        

        $this->addColumn('action', array(
            'header' => Mage::helper('newspaper')->__('Action'),
            'width' => '100px',
            'type' => 'action',
            'filter' => false,
            'actions' => array(
                array(
                    'caption' => Mage::helper('newspaper')->__('Edit'),
                    'url' => Mage::helper('adminhtml')->getUrl('adminhtml/ncrl_modelstyle/edit', array('id' => '$id'))
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
