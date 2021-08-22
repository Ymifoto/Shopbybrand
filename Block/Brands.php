<?php
namespace AVBox\Shopbybrand\Block;

class Brands extends \Magento\Framework\View\Element\Template {

    protected $_page;
    protected $_helper;
            
    public function __construct(
    \Magento\Backend\Block\Template\Context $context,
	\AVBox\Shopbybrand\Helper\Page $page,
	\AVBox\Shopbybrand\Helper\Data $helper
    )
    {    
        parent::__construct($context);
	$this->_page = $page;
	$this->_helper = $helper;
    }
    
/**
*	Get store URL
*	return string
*/

    public function getStoreUrl() {
    return $this->_helper->getStoreURL();
    }

/**
*	Get product collection
*	Return object
*/

    public function getCollection() {

    return $this->_helper->getProductCollection();

    }

    public function getManufacturersList() {
        $productlist = $this->getCollection()
        ->addAttributeToFilter('status', array('eq' => 1))
        ->addAttributeToSelect('manufacturer')
        ->getData();

        //$manufacturers = array();

        //foreach ($productlist as $row) {
        //    if (!empty($row['manufacturer'])){
        //    array_push($manufacturers, $row['manufacturer']);
	    //    }
        //}   
        return array_count_values(array_column($productlist,'manufacturer'));
    }

    public function getManufacturerId($attribute = 'manufacturer') {

    return $this->_page->getAttributeId($attribute);

    }

    public function getBrandsList() {

        return $this->_page->getModuleTableCollection()
                    ->addFieldToFilter('active',['eq'=>1])
                    ->addFieldToFilter('brand_code',['neq'=>0])
	                ->addFieldToSelect('brand')
                    ->addFieldToSelect('count')
                    ->getData();
    }

    public function getBrandsNameList() {

        return $this->_page->getManufacturerOptionsList();
    
    }

    public function getProba1() {

        return $this->_page->getBrandsName();

    }

    public function getBrandsPageURL() {

        return $this->_page->getBrandsPagePath();

    }

    public function getProba() {

        return $this->_page->getBrandsIDs()->getData();


    }

}





