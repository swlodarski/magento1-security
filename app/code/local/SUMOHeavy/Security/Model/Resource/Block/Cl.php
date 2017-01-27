<?php
class SUMOHeavy_Security_Model_Resource_Block_Cl extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('sumoheavy_security/block_cl', 'block_cl_id');
    }
}