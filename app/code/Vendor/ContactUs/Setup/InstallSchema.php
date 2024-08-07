<?php 
namespace Vendor\ContactUs\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (!$setup->tableExists('contact_us')) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('contact_us')
            )->addColumn(
                'contact_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Contact ID'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Name'
            )->addColumn(
                'email',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Email'
            )->addColumn(
                'telephone',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Telephone'
            )->addColumn(
                'comment',
                Table::TYPE_TEXT,
                '2M',
                ['nullable' => true],
                'Comment'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Created At'
            )->setComment(
                'Contact Us Table'
            );

            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}
