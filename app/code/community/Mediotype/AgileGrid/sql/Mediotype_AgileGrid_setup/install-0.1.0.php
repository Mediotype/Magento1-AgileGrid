<?php
/**
 * Created by PhpStorm.
 * User: szurek
 * Date: 7/9/14
 * Time: 12:12 PM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$agileGridTable = $installer->getConnection()->newTable($this->getTable('mediotype_agilegrid/filter'));

$agileGridTable->addColumn('id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array(
        'primary'   => true,
        'identity'  => true,
        'nullable'  => false,
        'unsigned'  => true,
    )
);

$agileGridTable->addColumn('name',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array(
        'nullable'  => false,
    )
);

$agileGridTable->addColumn('grid_id',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    511,
    array(
        'nullable'  => false,
    )
);

$agileGridTable->addColumn('filter',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array(
        'nullable'  => false,
    )
);

$agileGridTable->addIndex(
    $this->getIdxName('mediotype_agilegrid/filter', array('id')),
    array('id')
);

$installer->getConnection()->createTable($agileGridTable);

$installer->endSetup();
