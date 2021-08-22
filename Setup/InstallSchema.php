<?php 
namespace AVBox\Shopbybrand\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('avbox_shopbybrand');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                            ->addColumn(
                                'id',
                                Table::TYPE_INTEGER,
                                null,
	                        ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true],'ID'
                                )
                            ->addColumn(
                                'brand',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>false,'default'=>''],'Brand name'
                                )
                            ->addColumn(
                                'brand_code',
                                Table::TYPE_INTEGER,
                                10,
                                ['nullable'=>false],'Brand attribute code'
                                )
                            ->addColumn(
                                'count',
                                Table::TYPE_INTEGER,
                                null,
                                ['nullbale'=>false,'default'=>'0'],'Brand product count'
                                )
                            ->addColumn(
                                'picture',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>true],'Brand picture path'
                                )
                            ->addColumn(
                                'picture_alt',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>true],'Picture alt tag'
                                )
                            ->addColumn(
                                'meta_title',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>true],'Meta Title'
                                )
                            ->addColumn(
                                'meta_description',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>true],'Meta Description'
                                )
                            ->addColumn(
                                'meta_description',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>true],'Meta Description'
                                )
                            ->addColumn(
                                'meta_key',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>true],'Meta Keyword'
                                )
                            ->addColumn(
                                'path',
                                Table::TYPE_TEXT,
                                255,
                                ['nullable'=>true],'URL Path'
                                )
                            ->addColumn(
                                'active',
                                Table::TYPE_INTEGER,
                                1,
                                ['nullable'=>true],'Active page'
                                )
                            ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}