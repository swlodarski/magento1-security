<?php
/**
 * SUMOHeavy_Security
 *
 * @category   SUMOHeavy
 * @package    SUMOHeavy_Security
 * @copyright  Copyright (c) 2017 SUMO Heavy Industries, LLC
 * @author     Daniel Szubart <support@sumoheavy.com>
 */
class SUMOHeavy_Security_Block_Adminhtml_Rules_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'sumoheavy_security';
        $this->_controller = 'adminhtml_rules';
        $this->_mode = 'edit';
        
        $this->_updateButton('save', 'label', $this->__('Save Rule'));
    }

    /**
     * Get Header Text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('sumoheavy_rule_data') && Mage::registry('sumoheavy_rule_data')->getId()) {
            return $this->__("Edit Rule #%s", $this->escapeHtml(Mage::registry('sumoheavy_rule_data')->getId()));
        } else {
            return $this->__('New Rule');
        }
    }
}
