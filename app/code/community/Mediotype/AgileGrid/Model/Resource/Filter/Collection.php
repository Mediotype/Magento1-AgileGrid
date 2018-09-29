<?php
/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 7/15/14
 * Time: 7:26 PM
 */

class Mediotype_AgileGrid_Model_Resource_Filter_Collection extends Mediotype_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('mediotype_agilegrid/filter');
    }
}
