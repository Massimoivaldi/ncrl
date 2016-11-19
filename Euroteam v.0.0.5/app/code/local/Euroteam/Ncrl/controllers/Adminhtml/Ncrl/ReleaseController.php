<?php

class Euroteam_Ncrl_Adminhtml_Ncrl_ReleaseController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('euroteam')
                ->_title(Mage::helper('adminhtml')->__('Manage Newspaper Release'))
                ->_addContent($this->getLayout()->createBlock('newspaper/adminhtml_release'))
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('newspaper'), Mage::helper('adminhtml')->__('Manage Newspaper Release'));

        return $this;
    }

    public function gridAction() {
        $this->loadLayout();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('newspaper/adminhtml_release_grid')->toHtml()
        );
    }

    public function indexAction() {
        $this->_initAction();
        $this->renderLayout();
    }

    public function newAction() {

        $this->_forward('edit');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('newspaper/release')->load($id);
        if ($model->getId() || $id == 0) {
            Mage::register('release_data', $model);
            $this->loadLayout();
            $this->_setActiveMenu('euroteam');
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('newspaper/adminhtml_release_edit'))
                    ->_addLeft($this->getLayout()->createBlock('newspaper/adminhtml_release_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('newspaper')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction() {
        $param = $this->getRequest()->getParams();
        if (!empty($param['id'])) {
            $model = Mage::getModel('newspaper/release')->load($param['id']);
        } else {
            $model = Mage::getModel('newspaper/release');
        }

        $model->addData($param);

        try {
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('newspaper')->__('Item has been saved'));
            if (isset($param['back'])) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
            } else {
                $this->_redirect('*/*/');
            }
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($param);
            if (empty($param['id'])) {
                $this->_redirect('*/*/new');
            } else {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
            }
            return;
        }
        $this->_redirect('*/*/');
        return;
    }

    public function deleteAction() {
        $param = $this->getRequest()->getParams();
        if (isset($param['id'])) {
            try {
                $model = Mage::getModel("newspaper/release")->load($param['id']);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('newspaper')->__('Item has been successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $ex) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('newspaper')->__('Fail to delete item'));
                $this->_redirect('*/*/');
            }
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('newspaper')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
        return;
    }

}
