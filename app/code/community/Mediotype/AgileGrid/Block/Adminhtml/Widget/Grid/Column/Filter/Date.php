<?php
/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 7/9/14
 * Time: 10:24 AM
 */
class Mediotype_AgileGrid_Block_Adminhtml_Widget_Grid_Column_Filter_Date extends Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Date
{
    /**
     * @desc Process DateInterval Strings http://www.php.net/manual/en/dateinterval.construct.php
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        if (isset($value['locale'])) {
            if (!empty($value['from'])) {
                $value['from'] = Mage::helper('mediotype_agilegrid')->parseDateIntervalString($value['from']);
            }

            if (!empty($value['to'])) {
                $value['to'] = Mage::helper('mediotype_agilegrid')->parseDateIntervalString($value['to']);
            }
        }

        return parent::setValue($value);
    }
}