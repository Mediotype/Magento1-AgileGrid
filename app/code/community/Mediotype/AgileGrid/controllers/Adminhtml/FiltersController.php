<?php
/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 7/7/14
 * Time: 3:35 PM
 */
class Mediotype_AgileGrid_Adminhtml_FiltersController extends Mage_Adminhtml_Controller_Action
{
    public function saveAction()
    {
        $targetFilterName = trim($this->getRequest()->getParam('name'));
        try {
            $update = false;

            $filterModel = Mage::getModel('mediotype_agilegrid/filter');
            $filterModel->load(
                array(
                    "name" => $targetFilterName,
                    'grid_id' => trim($this->getRequest()->getParam('grid_id'))
                )
            );
            if ($filterModel->getId()) {
                $update = true;
            }

            $filterModel->setData('name', $targetFilterName);
            $filterModel->setData('grid_id', trim($this->getRequest()->getParam('grid_id')));
            $filterModel->setData('filter', $this->getRequest()->getParam('filter'));

            $filterModel->save();

            if ($update) {
                $this->_getSession()->addSuccess("Filter '$targetFilterName' UPDATED.");
                return;
            }

            $this->_getSession()->addSuccess("Filter '$targetFilterName' CREATED.");
            return;

        } catch (Exception $e) {
            $this->_getSession()->addError("ERROR saving filter '$targetFilterName'.");
            Mage::logException($e);
        }

        return;
    }

    public function deleteAction()
    {
        $targetFilterName = $this->getRequest()->getParam('name');
        try {
            /** @var Mediotype_AgileGrid_Model_Filter $filterModel */
            $filterModel = Mage::getModel('mediotype_agilegrid/filter');
            $filterModel->load(
                array(
                    "name" => $targetFilterName,
                    'grid_id' => $this->getRequest()->getParam('grid_id')
                )
            );
            if ($filterModel->getId()) {
                $filterModel->delete();
                $this->_getSession()->addSuccess("Filter '$targetFilterName' DELETED");
            } else {
                $this->_getSession()->addError("ERROR deleting filter - Could not find record $targetFilterName.");
            }
        } catch (Exception $e) {
            $this->_getSession()->addError("ERROR deleting filter '$targetFilterName'.");
            Mage::logException($e);
        }
    }

    protected function _isAllowed()
    {
        return Mage::helper('mediotype_core/acl')->isAllowed($this);
    }
}