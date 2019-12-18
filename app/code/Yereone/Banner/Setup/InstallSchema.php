<?php
namespace Yereone\Banner\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('banner')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('banner')
            )
                ->addColumn(
                    'banner_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'ID'
                )
                ->addColumn(
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Title'
                )
                ->addColumn(
                        'image',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Image'
                )
                ->addColumn(
                        'text',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Text'
                )
                ->addColumn(
                        'position',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Text Position'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At')
                ->setComment('Table');
            $installer->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}