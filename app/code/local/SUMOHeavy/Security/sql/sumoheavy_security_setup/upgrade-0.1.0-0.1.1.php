<?php
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table 'sumoheavy_security/rule'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sumoheavy_security/rule'))
    ->addColumn('rule_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Rule Id')
    ->addColumn('rule', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
    ), 'Rule')
    ->setComment('Security Rules');
$installer->getConnection()->createTable($table);