<?php

namespace AVBox\Shopbybrand\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {

    protected $eavConfig; 
    protected $brandFactory;

    public function __construct(

    \Magento\Eav\Model\Config $eavConfig,
    \AVBox\Shopbybrand\Model\BrandFactory $brandFactory

    ){
    $this->_eavConfig = $eavConfig;
    $this->_brandFactory = $brandFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {

    $datas = array(array('brand' => 'brands','brand_code' => '0','path' => 'brands'));
    $attribute = $this->_eavConfig->getAttribute('catalog_product', 'manufacturer')->getSource()->getAllOptions();

        foreach ($attribute as $row) {
	    if (!empty($row['value'])) {
	        array_push($datas,array('brand' => $row['label'],'brand_code' => $row['value'],'meta_key' => strtolower($row['label']),'path' => str_replace(' ','-',strtolower($row['label']))));
            }
        }

        foreach ($datas as $data) {
	    $post = $this->_brandFactory->create();
	    $post->addData($data)->save();
	}
    }
}
