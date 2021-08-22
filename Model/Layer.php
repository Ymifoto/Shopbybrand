<?php
namespace AVBox\Shopbybrand\Model;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory as AttributeCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Layer extends \Magento\Catalog\Model\Layer {

    protected $helper; 
    protected $table;

    public function __construct(
        \Magento\Catalog\Model\Layer\ContextInterface $context,
        \Magento\Catalog\Model\Layer\StateFactory $layerStateFactory,
        AttributeCollectionFactory $attributeCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product $catalogProduct,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        CategoryRepositoryInterface $categoryRepository,
        CollectionFactory $productCollectionFactory,
	\AVBox\Shopbybrand\Helper\Data $helper,
//	\AVBox\Shopbybrand\Helper\Table $table,
        array $data = []
    ) {
	$this->_helper = $helper;
//	$this->_table = $table;
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct(
            $context,
            $layerStateFactory,
            $attributeCollectionFactory,
            $catalogProduct,
            $storeManager,
            $registry,
            $categoryRepository,
            $data
        );
    }

    public function getProductCollection()    {

//	var_dump($this->_helper->getFlatProductEnabled());
//	echo 'Flat: ';
//	var_dump($this->_helper->getEntityIds());
//	echo '<br>';
//	var_dump($this->_helper->getBrandParam());
//	echo '<br>';
//	echo 'Branded products: ';
//	var_dump($this->_helper->getBrandedProductList($this->_helper->getBrandParam()));
//	echo '<br>';
//	echo 'Branded id: ';
//	var_dump($this->_helper->getManufacturerID());
//	echo '<br>';
//	echo '<br>';
//	echo '<br>';


	$entity = $this->_helper->getEntityIds();

        if (isset($this->_productCollections['avbox_shopbybrand'])) {
            $collection = $this->_productCollections['avbox_shopbybrand'];
        } else {
            //here you assign your own custom collection of products
            $collection = $this->productCollectionFactory->create()
	    ->addAttributeToFilter('entity_id', ['in' => $entity]);


            $this->prepareProductCollection($collection);
            $this->_productCollections['avbox_shopbybrand'] = $collection;
        }
	return $collection;
    }
}