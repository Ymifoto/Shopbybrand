<?php
namespace AVBox\Shopbybrand\Helper;

class Page extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $eavConfig;
    protected $eavAttribute;
    protected $brandFactory;
    
    public function __construct(

        \Magento\Eav\Model\Config $eavConfig,
	    \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute,
        \AVBox\Shopbybrand\Model\BrandFactory $brandFactory

    ) {
	    $this->_eavConfig = $eavConfig;
	    $this->_eavAttribute = $eavAttribute;
	    $this->_brandFactory = $brandFactory;
    }

/**c
*	Get module table data
*	Return object
*/

    public function getModuleTable() {
        
        return $this->_brandFactory->create();
                                   
    }

    public function getModuleTableCollection() {
        
        return $this->getModuleTable()->getCollection();
    }

/**
*	Get active brands IDs
*	Return array
*/
public function getBrandsIDs() {
    
    return $this->getModuleTableCollection()
                ->addFieldToSelect('brand_code')
                ->addFieldToSelect('id')
                ->addFieldToFilter('brand_code',['neq'=> 0]);
}

/**
*	Get active brands page path 
*	Return array
*/

    public function getBrandsPagePath() {
        
        return $this->getModuleTableCollection()
	                ->addFieldToFilter('active',['eq'=>1])
	                ->addFieldToFilter('brand_code',['eq'=>0])
                    ->addFieldToSelect('*')
                    ->getData();
    }

/**
*	Get selected brand code
*   Param brand name    
*	Return array
*/

    public function getBrandNameId($name) {
    
        return $this->getModuleTableCollection()
	                ->addFieldToFilter('path',['eq'=>$name])
	                ->addFieldToSelect('brand_code')
	                ->getData();
    }

    public function getSelectedBrand($brand) {

        return $table = $this->getModuleTableCollection()
                             ->addFieldToSelect('brand')
                            //->addFieldToFilter('brand_code',['neq'=> 0])
                             ->addFieldToFilter('brand',['eq'=> $brand])
                             ->getData();
    }

/**
*	Get attribute ID
*   Param attribute name
*	Return string
*/

    public function getAttributeId($attribute = 'manufacturer') {

        return $this->_eavAttribute->getIdByCode('catalog_product',$attribute);
    }

/**
*	Get manufacturer attribute options
*	Return array
*/
    public function getManufacturerOptionsList() {
        
        $attribute_id = $this->getAttributeId();
        $attribute = $this->_eavConfig->getAttribute('catalog_product', $attribute_id);
        return $attribute->getSource()->getAllOptions();
    }


    //ideiglenes
    public function getBrandsName() {
    
        return $this->getModuleTableCollection()
	                ->addFieldToFilter('brand_code',['neq'=>0])
	                ->addFieldToSelect('brand')
                    ->addFieldToSelect('brand_code')
                    ->addFieldToSelect('id')
                    ->getData();

    }
}
