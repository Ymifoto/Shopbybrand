<?php
namespace AVBox\Shopbybrand\Model\ResourceModel;

    class Brand extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

        protected function _construct() {

            $this->_init('avbox_shopbybrand', 'id');
	}
    }
