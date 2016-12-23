<?php
class SUMOHeavy_Security_Model_Resource_Config_Data_Cl extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('sumoheavy_security/config_data_cl', 'config_cl_id');
    }
}