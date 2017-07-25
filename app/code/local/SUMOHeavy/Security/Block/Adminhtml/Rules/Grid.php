<?php
/**
 * SUMOHeavy_Security
 *
 * @category   SUMOHeavy
 * @package    SUMOHeavy_Security
 * @copyright  Copyright (c) 2017 SUMO Heavy Industries, LLC
 * @author     Daniel Szubart <support@sumoheavy.com>
 */
class SUMOHeavy_Security_Block_Adminhtml_Rules_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('rulesGrid');
        $this->setDefaultSort('rule_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for grid
     * 
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sumoheavy_security/rule')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns for grid
     * 
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'rule_id', array(
            'header'    => $this->__('Rule ID'),
            'index'     => 'rule_id',
            'type'      => 'number',
            'column_css_class'     => 'id'
            )
        );

        $this->addColumn(
            'rule', array(
            'header'    => $this->__('Rule'),
            'index'     => 'rule'
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * Retrieves Grid Url
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    /**
     * Retrieves row click URL
     *
     * @param  mixed $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
