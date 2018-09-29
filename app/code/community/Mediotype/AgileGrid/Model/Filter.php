<?php
/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 7/15/14
 * Time: 5:58 PM
 */
class Mediotype_AgileGrid_Model_Filter extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('mediotype_agilegrid/filter', 'id');
    }
}