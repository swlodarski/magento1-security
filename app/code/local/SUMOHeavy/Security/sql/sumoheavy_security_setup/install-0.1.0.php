<?php
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table 'sumoheavy_security/config_data_cl'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sumoheavy_security/config_data_cl'))
    ->addColumn('config_cl_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Config Id')
    ->addColumn('config_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
    ), 'Old Config Id')
    ->addColumn('scope_old', Varien_Db_Ddl_Table::TYPE_TEXT, 8, array(
        'nullable'  => false,
        'default'   => 'default',
    ), 'Old Config Scope')
    ->addColumn('scope_new', Varien_Db_Ddl_Table::TYPE_TEXT, 8, array(
        'nullable'  => false,
        'default'   => 'default',
    ), 'New Config Scope')
    ->addColumn('scope_id_old', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'default'   => '0',
    ), 'Old Config Scope Id')
    ->addColumn('scope_id_new', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'default'   => '0',
    ), 'New Config Scope Id')
    ->addColumn('path_old', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        'default'   => 'general',
    ), 'Old Config Path')
    ->addColumn('path_new', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        'default'   => 'general',
    ), 'New Config Path')
    ->addColumn('value_old', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Old Config Value')
    ->addColumn('value_new', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'New Config Value')
    ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Config Data Changelog Timestamp')
    ->setComment('Config Data Changelog');
$installer->getConnection()->createTable($table);


/**
 * Create trigger for core/config_data > sumoheavy_security/config_data
 *
 * This trigger observes UPDATEs run on core/config_data, and then
 * inserts the changes into sumoheavy_security/config_data.
 */
$trigger = new Magento_Db_Sql_Trigger();

$trigger->setTime($trigger::SQL_TIME_AFTER);
$trigger->setEvent($trigger::SQL_EVENT_UPDATE);
$trigger->setTarget($installer->getTable('core/config_data'));
$trigger->setBody(
    'INSERT INTO ' . $installer->getTable('sumoheavy_security/config_data_cl') . ' VALUES (NULL, NEW.config_id, OLD.scope, NEW.scope, OLD.scope_id, NEW.scope_id, OLD.path, NEW.path, OLD.value, NEW.value, NOW());'
);
$triggerCreateQuery = $trigger->assemble();
$this->getConnection()->query($triggerCreateQuery);

$installer->endSetup();

/**
 * Create table 'sumoheavy_security/block_cl'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sumoheavy_security/block_cl'))
    ->addColumn('block_cl_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Block Changelog ID')
    ->addColumn('block_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
    ), 'Block ID')
    ->addColumn('title_old', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
    ), 'Old Block Title')
    ->addColumn('title_new', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
    ), 'New Block Title')
    ->addColumn('identifier_old', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
    ), 'Old Block String Identifier')
    ->addColumn('identifier_new', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
    ), 'New Block String Identifier')
    ->addColumn('content_old', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
    ), 'Old Block Content')
    ->addColumn('content_new', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
    ), 'New Block Content')
    ->addColumn('is_active_old', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'default'   => '1',
    ), 'Old Is Block Active')
    ->addColumn('is_active_new', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'default'   => '1',
    ), 'New Is Block Active')
    ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Block Changelog Timestamp')
    ->setComment('CMS Block Changelog Table');
$installer->getConnection()->createTable($table);


/**
 * Create trigger for cms/block > sumoheavy_security/block_cl
 *
 * This trigger observes UPDATEs run on cms/block, and then
 * inserts the changes into sumoheavy_security/block_cl.
 */
$trigger = new Magento_Db_Sql_Trigger();

$trigger->setTime($trigger::SQL_TIME_AFTER);
$trigger->setEvent($trigger::SQL_EVENT_UPDATE);
$trigger->setTarget($installer->getTable('cms/block'));
$trigger->setBody(
    'INSERT INTO ' . $installer->getTable('sumoheavy_security/block_cl') . ' VALUES (NULL, NEW.block_id, OLD.title, NEW.title, OLD.identifier, NEW.identifier, OLD.content, NEW.content, OLD.is_active, NEW.is_active, NOW());'
);
$triggerCreateQuery = $trigger->assemble();
$this->getConnection()->query($triggerCreateQuery);

$installer->endSetup();