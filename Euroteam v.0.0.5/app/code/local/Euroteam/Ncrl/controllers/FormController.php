<?php

class Euroteam_Ncrl_FormController extends Mage_Core_Controller_Front_Action
{

    public function indexAction() {

        $this->loadLayout();
        $this->renderLayout();
    }

    public function getNewspaperReleaseAction() {
        $params = $this->getRequest()->getParams();
        $collection = Mage::getModel('newspaper/release')->getCollection()
                ->addFieldToFilter('main_table.id_newspaper', $params['newspaper']);
        $result = array();
        foreach ($collection as $item) {
            $result[$item->getId()] = array(
                'selected' => false,
                'label' => $item->getName()
            );
        }
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }

    public function getNewspaperReleaseSectionAction() {
        $params = $this->getRequest()->getParams();
        $collection = Mage::getModel('newspaper/section')->getCollection()
                ->addFieldToFilter('main_table.id_newspaper_release', $params['release']);
        $result = array();
        foreach ($collection as $item) {
            $result[$item->getId()] = array(
                'selected' => false,
                'label' => $item->getName()
            );
        }
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }

    public function getNewspaperReleaseSectionModelAction() {
        $params = $this->getRequest()->getParams();
        $collection = Mage::getModel('newspaper/sectionmodel')->getCollection()
                ->addFieldToFilter('main_table.id_newspaper_release_section', $params['section']);
        $collection->getSelect()
                ->joinLeft(array("section" => "newspaper_release_section"), "main_table.id_newspaper_release_section = section.id", array("section_name" => "section.name"))
                ->joinLeft(array("model" => "ncrl_model"), "main_table.id_ncrl_model = model.id", array("model_name" => "model.name"));

        $result = array();
        foreach ($collection as $item) {
            $result[$item->getId()] = array(
                'selected' => false,
                'label' => $item->getSectionName() . " / " . $item->getModelName()
            );
        }
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }

    public function getModelStyleAction() {
        $params = $this->getRequest()->getParams();
        $rsm = Mage::getModel('newspaper/sectionmodel')->load($params['section_model']);
        $style = Mage::getModel('newspaper/modelstyle')->getCollection()
                ->addFieldToFilter('id_ncrl_model', $rsm->getIdNcrlModel());
        $modelModel = Mage::getModel('newspaper/model')->load($rsm->getIdNcrlModel());

        $result = "";
        $result .= '<p class="titoletto">' . $modelModel->getName() . '</p>';
        foreach ($style as $item) {
            if (empty($item->getImage()))
                continue;
            $imageUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $item->getImage();
            $result .= '
                    <div class="col-md-6">
                        <div class="radio">
                            <label style="min-height: 40px;">
                                <input type="radio" class="style-image-item" name="tipoannuncio" id="tipoannuncio:' . $item->getId() . '" value="' . $item->getId() . '">
                                ' . $item->getName() . '
                            </label>
                        </div>
                        <p><img src="' . $imageUrl . '"  class="preview"></p>
                    </div>
                    ';
        }

        echo $result;
        exit();
    }

    public function getModelFieldAction() {
        $params = $this->getRequest()->getParams();
        $result = array(
            'fields' => '',
            'preview' => '',
            'final' =>  ''
        );
        if (empty($params['style'])) {
            $this->getResponse()->setBody(Zend_Json::encode($result));
        }

        $modelFields = Mage::getModel('newspaper/modelfield')->getCollection()
                ->addFieldToFilter('id_ncrl_model_style', $params['style'])
                ->setOrder('id','ASC');
        
        
        $modelFields->getSelect()->joinLeft(array('field' => 'ncrl_field'), "main_table.id_ncrl_field = field.id", array('field_name' => 'field.name'))
                ->joinLeft(array('style' => 'ncrl_model_style'), "main_table.id_ncrl_model_style = style.id", array('style_name' => 'style.name'));

        /*
         * populate html for field
         */

        $fields = "";
        $preview = "";
        $finalPreview = "";
        $finalFields = "";
        
        foreach ($modelFields as $modelField) {
            $mandatory = $modelField->getMandatory() == 1 ? "required-entry" : "";
            $required = $modelField->getMandatory() == 1 ? "required" : "";
            $fields .= '<div class="form-group">
                <label for="modelField:'.$modelField->getId().'">'. $modelField->getFieldName() .'</label>
                    <textarea data-price="'.$modelField->getPrice().'" data-weight="'.$modelField->getWeight().'" data-minweight="'.$modelField->getMinimumWeight().'"  data-id='.$modelField->getId().' id="modelField:'.$modelField->getId().'" class="modelField form-control '.$mandatory.'" rows="3" name="modelField['.$modelField->getId().']" '.$required.'></textarea>
                </div>';
            $style = trim(preg_replace('/\s\s+/', ' ', $modelField->getStyle()));
            $preview .= "<p id='modelFieldPreview:". $modelField->getId() ."' style='$style'></p>";            
            $finalPreview .= "<p id='modelFieldFinalPreview:". $modelField->getId() ."' style='$style'></p>";
            
            $finalFields .= '<p id="finalFieldWrapper:'.$modelField->getId().'" style="display:none;">N. Parole in <strong>'.$modelField->getFieldName().'</strong>: <b><span class="finalFieldWords" id="finalFieldWords:'.$modelField->getId().'">0</span></b>, prezzo: <b><span class="finalFieldPrice" id="finalFieldPrice:'.$modelField->getId().'">0</span></b> &euro;</p>';
            
        }
        
        $result['fields'] = $fields;
        $result['preview'] = $preview;
        $result['final'] = $finalPreview;
        $result['final_fields'] = $finalFields;
        
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }

}
