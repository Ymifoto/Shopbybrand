<?php
namespace AVBox\Shopbybrand\Block;

class Brand extends \Magento\Framework\View\Element\Template {

    protected $request;
    protected $helper;

    public function __construct(
    
    \Magento\Framework\App\Request\Http $request,
    \Magento\Framework\View\Element\Template\Context $context,
    array $data = [],
    \AVBox\Shopbybrand\Helper\Data $helper
    
    ) {

    $this->_request = $request;
    parent::__construct($context, $data);
    $this->_helper = $helper;

    
    }

/**
*	Get current url
*	Return string
*/
    public function getCurrentUrl() {

	$baseurl = $this->_storeManager->getStore()->getBaseUrl();
        return str_replace($baseurl . 'brands/','',$this->_storeManager->getStore()->getCurrentUrl());
    }

/**
*	Get brand URL param
*	Return string
*/
    public function getBrandParam() {

        return $this->_request->getParam('brand');
    }

    public function getBrandedProductList($brand) {

        return $this->_helper->getBrandedProductList($brand);
    }

}
