<?php
namespace AVBox\Shopbybrand\Block;

class Logo extends \Magento\Framework\View\Element\Template {

    protected $_registry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
	$this->_registry = $registry;
	parent::__construct($context, $data);
    }

    private function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }

    public function getBrand() {
        $product = $this->getCurrentProduct();
        $brand = $product->getResource()->getAttribute('manufacturer')->getFrontend()->getValue($product);
	return $brand;
    }

    public function getMediaUrl() {
	return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getPlaceholder()
    {
	$placeholder = $this->_storeManager->getStore()->getConfig('catalog/placeholder/image_placeholder');
	return $this->getMediaUrl() . 'catalog/product/placeholder/' . $placeholder;
    }
}
