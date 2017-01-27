<?php
class SUMOHeavy_Security_Model_Resource_Rule_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Initialization here
     *
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('sumoheavy_security/rule');
    }
}