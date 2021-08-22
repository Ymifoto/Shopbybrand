<?php
namespace AVBox\Shopbybrand\Controller\Brand;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $page;
    protected $pageFactory;

    public function __construct(

    \AVBox\Shopbybrand\Helper\Page $page,
    \Magento\Framework\App\Action\Context $context,
	\Magento\Framework\View\Result\PageFactory $pageFactory)
    {
	$this->_page = $page;
	$this->_pageFactory = $pageFactory;
	return parent::__construct($context);
    }

    public function execute()
    {

	$pageFactory = $this->_pageFactory->create();
	$urlparams = $this->getRequest()->getParams();


	// Add breadcrumb
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => '/'
            ]
        );
        $breadcrumbs->addCrumb('brands',
            [
                'label' => $this->_page->getBrandsPagePath()[0]['meta_title'],
                'title' => $this->_page->getBrandsPagePath()[0]['meta_title'],
                'link' => '/' . $this->_page->getBrandsPagePath()[0]['path']
            ]
        );
        $breadcrumbs->addCrumb('brand',
            [
                'label' => str_replace('-',' ',$urlparams['brand']),
                'title' => str_replace('-',' ',$urlparams['brand'])
            ]
        );

	return $pageFactory;
    }

//    public function getUrlParams() {
//
//    return $this->getRequest()->getParams();
//
//    }

}
