<?php
/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 7/15/14
 * Time: 7:24 PM
 */

class Mediotype_AgileGrid_Model_Resource_Filter extends Mediotype_Core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->_init('mediotype_agilegrid/filter', 'id');
    }
}