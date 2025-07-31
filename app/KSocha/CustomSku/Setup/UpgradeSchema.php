<?php
namespace KSocha\CustomSku\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            if (!$setup->tableExists('ksocha_customsku_log')) {
                $table = $setup->getConnection()->newTable(
                    $setup->getTable('ksocha_customsku_log')
                )->addColumn(
                    'log_id', Table::TYPE_INTEGER, null, [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ], 'Log ID'
                )->addColumn(
                    'product_id', Table::TYPE_INTEGER, null, ['nullable' => false], 'Product ID'
                )->addColumn(
                    'old_value', Table::TYPE_TEXT, 255, [], 'Old Custom SKU'
                )->addColumn(
                    'new_value', Table::TYPE_TEXT, 255, [], 'New Custom SKU'
                )->addColumn(
                    'user_id', Table::TYPE_INTEGER, null, ['nullable' => true], 'Admin User ID'
                )->addColumn(
                    'changed_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT], 'Changed At'
                )->setComment('Custom SKU Change Log');

                $setup->getConnection()->createTable($table);
            }
        }

        $setup->endSetup();
    }
}
