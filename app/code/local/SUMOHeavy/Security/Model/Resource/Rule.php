<?php
class SUMOHeavy_Security_Model_Resource_Rule extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('sumoheavy_security/rule', 'rule_id');
    }
}