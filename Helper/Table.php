<?php
namespace AVBox\Shopbybrand\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\ObjectManager;

class Table extends AbstractHelper {

    protected $resourceConnection;

    public function __construct(Context $context, ResourceConnection $resourceConnection)
    {
        $this->_resourceConnection = $resourceConnection;
        parent::__construct($context);
    }


    public function getConnection() {

    $connection = $this->_resourceConnection->getConnection();
    return $connection;

    }

    public function getTableName($name) {

    $table = $this->_resourceConnection->getTableName($name);
    return $table;

    }

//    public function runSqlQuery($table)
//    {
//        $connection = $this->resourceConnection->getConnection();
//        // $table is table name
//        $table = $connection->getTableName('my_custom_table');
//        //For Select query
//        $query = "Select * FROM " . $table;
//        $result = $connection->fetchAll($query);
//        $this->_logger->log(print_r($result, true));
//        $id = 2;
//        $query = "SELECT * FROM `" . $table . "` WHERE id = $id ";
//        $result1 = $connection->fetchAll($query);
//        $this->_logger->log(print_r($result1, true));
//    }

}