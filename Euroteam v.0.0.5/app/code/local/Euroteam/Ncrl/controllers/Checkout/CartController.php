<?php

class Euroteam_Ncrl_Checkout_CartController extends Mage_Core_Controller_Front_Action
{

    public function addToCartAction() {
        $params = $this->getRequest()->getParams();
        
        $product = Mage::getModel('catalog/product');
        $id = Mage::getModel('catalog/product')->getResource()->getIdBySku('ads');
        if ($id) {
            $product->load($id);
        }


        $adsInfo = array();

        try {
            if(count($params) < 1) {
                throw new Exception($this->__("Invalid Parameter!"));
            }
            $adsInfo['newspaper'] = $params['newspaper'];
            $adsInfo['release'] = $params['release'];
            $adsInfo['section'] = $params['section'];
            $adsInfo['relationship'] = $params['relationship'];
            $adsInfo['date'] = $params['date'];
            $adsInfo['prefill_name'] = $params['prefill_name'];
            $adsInfo['first_name'] = $params['first_name'];
            $adsInfo['last_name'] = $params['last_name'];
            $adsInfo['section_model'] = $params['section_model'];

            $adsInfo['newspaper_text'] = Mage::getModel('newspaper/newspaper')->load($params['newspaper'])->getName();
            $adsInfo['release_text'] = Mage::getModel('newspaper/release')->load($params['release'])->getName();
            $adsInfo['section_text'] = Mage::getModel('newspaper/section')->load($params['section'])->getName();
            $adsInfo['relationship_text'] = Mage::getModel('newspaper/relationship')->load($params['relationship'])->getName();
            $sectionModelCollection = Mage::getModel('newspaper/sectionmodel')->getCollection();

            $sectionModelCollection->getSelect()->joinLeft(array('model' => 'ncrl_model'), "main_table.id_ncrl_model = model.id", array('model_name' => 'model.name'));
            $sectionModel = $sectionModelCollection->getFirstItem();
            $adsInfo['section_model_text'] = $sectionModel->getModelName();

            $modelFieldParam = $params['modelField'];
            $modelFieldCollection = Mage::getModel('newspaper/modelfield')->getCollection()
                    ->addFieldToFilter('main_table.id', array('in' => array_keys($params['modelField'])));

            $modelFieldCollection->getSelect()->joinLeft(array('field' => 'ncrl_field'), "main_table.id_ncrl_field = field.id", array('field_name' => 'field.name'));

            $fieldData = array();
            $total = 0;
            $totalFields = 0;
            $totalWords = 0;
            foreach ($modelFieldCollection as $mf) {
                $tmpData = array();
                $tmpData['field'] = $mf->getFieldName();
                $style = trim(preg_replace('/\s\s+/', ' ', $mf->getStyle()));
                $tmpData['style'] = (string) $style;
                $tmpData['text'] = $modelFieldParam[$mf->getId()];
                $fieldData[$mf->getId()] = $tmpData;
                
                $totalFieldWeight = str_word_count($tmpData['text']) * $mf->getWeight();
                if($totalFieldWeight < $mf->getMinimumWeight()) {
                    $totalFieldWeight = $mf->getMinimumWeight();
                }
                $subtotal = $totalFieldWeight * $mf->getPrice();
                $tmpData['price'] = $subtotal;
                $total += $subtotal;
                $totalFields++;
                $totalWords += str_word_count($tmpData['text']);
            }
            
            $adsInfo['total_fields'] = $totalFields;
            $adsInfo['total_words'] = $totalWords;
            $adsInfo['fieldData'] = $fieldData;                        
            $adsInfo['total'] = $total;
            
            //$this->emptyCartAction();                                    
                                   
            $quoteObj = Mage::getSingleton('checkout/cart')->getQuote();                                                

            
            $quoteItem = Mage::getModel('sales/quote_item')->setProduct($product);
            $quoteItem->getProduct()->setIsSuperMode(true);
            $quoteItem->setOriginalCustomPrice($total);
            $quoteItem->setQty(1);
            $quoteItem->setPrice($total);
            $quoteItem->setCustomPrice($total);
            $quoteItem->setAdsInfo(serialize($adsInfo));
            
            $quoteObj->addItem($quoteItem);
            $quoteObj->collectTotals();
            $quoteObj->save();
            Mage::getSingleton('checkout/cart')->save();

        } catch (Exception $ex) {
            Mage::log($ex->getMessage(), null, 'error.log');
            Mage::getSingleton('core/session')->addError($this->__($ex->getMessage()));
            $this->_redirectReferer();
            return;
        }
        
        $this->_redirect('checkout/cart/index');
        return;
    }

    public function emptyCartAction() {
        $cartHelper = Mage::helper('checkout/cart');
        $items = $cartHelper->getCart()->getItems();
        foreach ($items as $item) {
            $itemId = $item->getItemId();
            $cartHelper->getCart()->removeItem($itemId)->save();
        }

        return true;
    }

}
