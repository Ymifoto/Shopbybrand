<?php
namespace AVBox\Shopbybrand\Model\ResourceModel\Brand;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    protected function _construct()
    {
        $this->_init(
        'AVBox\Shopbybrand\Model\Brand',
        'AVBox\Shopbybrand\Model\ResourceModel\Brand'
    );
    }
}

