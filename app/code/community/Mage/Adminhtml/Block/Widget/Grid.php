<?php
class Mage_Adminhtml_Block_Widget_Grid extends Mediotype_AgileGrid_Block_Adminhtml_Original_Block_Widget_Grid
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::helper('mediotype_core/acl')->isAllowed('adminhtml_filters', 'usefilters', 'mediotype_agilegrid')) {
            if (Mage::helper('mediotype_core/acl')->isAllowed('adminhtml_filters', 'save', 'mediotype_agilegrid')) {
                $this->setChild(
                    'save_filter_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(
                            array(
                                'label' => Mage::helper('adminhtml')->__('Save Filter'),
                                'onclick' => "saveFilter('" . $this->getHtmlId() . "', '" . $this->getUrl(
                                        'Mediotype_AgileGrid/Adminhtml_Filters/save'
                                    ) . "')",
                                'class' => 'save'
                            )
                        )
                );
            }

            if (Mage::helper('mediotype_core/acl')->isAllowed('adminhtml_filters', 'delete', 'mediotype_agilegrid')) {
                $this->setChild(
                    'delete_filter_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(
                            array(
                                'label' => Mage::helper('adminhtml')->__('Delete Filter'),
                                'onclick' => "deleteFilter('" . $this->getHtmlId() . "', '" . $this->getUrl(
                                        'Mediotype_AgileGrid/Adminhtml_Filters/delete'
                                    ) . "')",
                                'class' => 'delete'
                            )
                        )
                );
            }

            $this->setChild(
                'reset_filter_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(
                        array(
                            'label' => Mage::helper('adminhtml')->__('Reset Filter'),
                            'onclick' => "loadFilter('" . $this->getHtmlId() . "', '','')",
                        )
                    )
            );
        }

        return $this;
    }

    public function getMainButtonsHtml()
    {
        if (Mage::helper('mediotype_core/acl')->isAllowed('adminhtml_filters', 'usefilters', 'mediotype_agilegrid')) {
            $selectedFilterName = $this->getRequest()->getParam('selectedFilterName', '');
            $filtersCollection = Mage::getModel('mediotype_agilegrid/filter')
                ->getCollection()
                ->addFieldToFilter('grid_id', $this->getId())
                ->load();
            $html = '';
            if ($this->getFilterVisibility()) {
                $html .= "<b>Filters&nbsp;</b>";
                $html .= "<select id='filters'>";
                if (Mage::helper('mediotype_core/acl')->isAllowed('adminhtml_filters', 'save', 'mediotype_agilegrid')) {
                    $html .= "<option value=''>New Filter</option>";
                } else {
                    $html .= "<option value=''></option>";
                }

                foreach ($filtersCollection as $filterModel) {
                    /** @var $filterModel Mediotype_AgileGrid_Model_Filter */
                    $html .=
                        "<option value='" . $filterModel->getData(
                            'filter'
                        ) . "' " . (($selectedFilterName == $filterModel->getData('name')) ? 'selected' : null) . ">";
                    $html .= $filterModel->getData('name');
                    $html .= "</option>";
                }

                $html .= "</select>";
                $html .= $this->getChildHtml('save_filter_button');

                if ($selectedFilterName) {
                    $html .= $this->getChildHtml('delete_filter_button');
                }

                $html .= $this->getResetFilterButtonHtml();
                $html .= $this->getSearchButtonHtml();
            }
            return $html;
        }
        return parent::getMainButtonsHtml();
    }

    protected function _toHtml()
    {
        if (Mage::helper('mediotype_core/acl')->isAllowed('adminhtml_filters', 'usefilters', 'mediotype_agilegrid')) {
            $html = parent::_toHtml();
            $html .= "\r\n
        <script type=\"text/javascript\">
        $$('#" . $this->getHtmlId() . " #filters')[0].observe('change', function (event) {
            console.log(event.target.selectedOptions[0].label)
            if (event.target.value != '') {
                loadFilter('" . $this->getHtmlId() . "', event.target.value, event.target.selectedOptions[0].label);
            } else {
                " . $this->getJsObjectName() . ".addVarToUrl('selectedFilterName', '');
                " . $this->getJsObjectName() . ".resetFilter();
            }
        });
        </script>";
            return $html;
        } else {
            return parent::_toHtml();
        }

    }

}
