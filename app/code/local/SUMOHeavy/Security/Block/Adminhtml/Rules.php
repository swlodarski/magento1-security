<?php
/**
 * SUMOHeavy_Security
 *
 * @category   SUMOHeavy
 * @package    SUMOHeavy_Security
 * @copyright  Copyright (c) 2017 SUMO Heavy Industries, LLC
 * @author     Daniel Szubart <support@sumoheavy.com>
 */
class SUMOHeavy_Security_Block_Adminhtml_Rules
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'sumoheavy_security';
        $this->_controller = 'adminhtml_rules';
        $this->_headerText = $this->__('Rule');

        parent::__construct();
    }
}