<?php
/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 7/9/14
 * Time: 12:12 PM
 */
class Mediotype_AgileGrid_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function parseDateIntervalString($value, $dateFormat = 'm/d/Y')
    {

        if (substr($value, 0, 1) == 'P' || substr($value, 0, 2) == '-P') {
            $action = 'add';
            if (substr($value, 0, 1) == '-') {
                $value = ltrim($value, '-');
                $action = 'sub';
            }

            $timeStamp = Mage::getModel('core/date')->timestamp(time());
            $today = new DateTime(date("Y-m-d 00:00:00", $timeStamp));

            $today->$action(new DateInterval($value));
            $value = $today->format($dateFormat);
        }
        return $value;
    }
}