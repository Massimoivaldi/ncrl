<?php

class Euroteam_Ncrl_Block_Adminhtml_Template_Grid_Renderer_SectionNewspaper extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row) {        
        return $row->getNewspaperName() . " - " . $row->getReleaseName();        
    }

}
