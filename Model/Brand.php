<?php
namespace AVBox\Shopbybrand\Model;

    class Brand extends \Magento\Framework\Model\AbstractModel {

        protected function _construct() {

            $this->_init('AVBox\Shopbybrand\Model\ResourceModel\Brand');
        }
    }
