<?php

class Euroteam_Ncrl_Model_Source_Status
{

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return array(
            array('value' => self::STATUS_ACTIVE, 'label' => Mage::helper('adminhtml')->__('Active')),
            array('value' => self::STATUS_INACTIVE, 'label' => Mage::helper('adminhtml')->__('Inactive')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray() {
        return array(
            self::STATUS_ACTIVE => Mage::helper('adminhtml')->__('Active'),
            self::STATUS_INACTIVE => Mage::helper('adminhtml')->__('Inactive'),
        );
    }

}
