<?php

namespace AmeniMage\DealWithDb\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();
        if($installer->tableExists('AmeniMage_post')){
            $table=$installer->getConnection()->newTable(
                $installer->getTable('AmeniMage_post')
            )->addColumn(
                'post_id',
                Table::TYPE_INTEGER,
                     null,
                [
                    'identity' => true,
                    'primary'=>true,
                    'nullable'=>false,
                    'unsigned' => true,
                ]
            )->addColumn(
                  'title',
                Table::TYPE_TEXT,
                255,
                ['nullable'=>false]
            )->addColumn(
                'content',
                Table::TYPE_TEXT,
                "64K",
                []
            )->setComment('this is post comment');
        $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
