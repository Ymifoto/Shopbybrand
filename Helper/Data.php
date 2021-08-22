<?php
namespace AVBox\Shopbybrand\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_scopeConfig;
    protected $_productCollectionFactory;
    protected $_request;
    protected $_table;
    protected $_page;
    protected $_storeManager;

    public function __construct(

	    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
	    \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
	    \Magento\Framework\App\Request\Http $request,
	    \AVBox\Shopbybrand\Helper\Table $table,
	    \AVBox\Shopbybrand\Helper\Page $page,
	    \Magento\Store\Model\StoreManagerInterface $storeManager

    ) {

	    $this->scopeConfig = $scopeConfig;
	    $this->_productCollectionFactory = $productCollectionFactory;
	    $this->_request = $request;
	    $this->_table = $table;
	    $this->_page = $page;
	    $this->_storeManager = $storeManager;

    }

/**
* Get Flat Data on/off
*/
    public function getFlatProductEnabled() {

        return $this->scopeConfig->getValue('catalog/frontend/flat_catalog_product');

    }

    public function getBrandParam() {

        return $this->_request->getParam('brand');
    } 

    public function getEntityIds() {

	    $brandname = $this->getBrandParam();

	    if ($this->getFlatProductEnabled() == 1) {
	        $connection = $this->_table->getConnection();

	        $connection->rawQuery("SET SESSION group_concat_max_len = 1000000;");

	        $result = $connection->fetchAll("SELECT GROUP_CONCAT(entity_id) as entity FROM " . $this->getFlatTableName() . " WHERE manufacturer_value = '" . $this->getBrandParam()  . "';");
	        return implode($result[0]);
	    }
	    else {
	        $entitys = $this->getBrandedProductList($this->getManufacturerID());
	        return $entitys;
	    }
    } 

    public function getFlatTableName() {

        $table = 'catalog_product_flat_' . $this->_storeManager->getStore()->getId();

        return $this->_table->getTableName($table);

    }

    public function getStoreURL() {

        return $this->_storeManager->getStore()->getBaseUrl();

    }
/**
*	Get product collection
*	return object
*/
    public function getProductCollection()
    {
        return $this->_productCollectionFactory->create();
    } 

    public function getManufacturerID() {

	    return $this->_page->getBrandNameId($this->getBrandParam());

    }


/**
*	Get entity IDs by manufacturer name
*	return array
*/

    public function getBrandedProductList($brand) {

        $productlist = $this->getProductCollection()
                            ->addAttributeToFilter('status', array('eq' => 1))
	                        ->addAttributeToSelect('entity_id')
	                        ->addAttributeToFilter('manufacturer', array('eq' => $brand))
	                        ->getData();

        return implode(',',array_column($productlist,'entity_id'));
    }
}
