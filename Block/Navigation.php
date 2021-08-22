<?php
namespace AVBox\Shopbybrand\Block;

class Navigation extends \Magento\LayeredNavigation\Block\Navigation
{
    public function __construct(
	\Magento\Framework\View\Element\Template\Context $context,
	\AVBox\Shopbybrand\Model\Layer\Resolver $layerResolver,
	\Magento\Catalog\Model\Layer\FilterList $filterList,
	\Magento\Catalog\Model\Layer\AvailabilityFlagInterface $visibilityFlag,
	array $data = []
    ) {
	parent::__construct($context, $layerResolver, $filterList,
	    $visibilityFlag);
    }
}
