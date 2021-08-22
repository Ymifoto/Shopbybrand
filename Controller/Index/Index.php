<?php
namespace AVBox\Shopbybrand\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $page;

    public function __construct(

        \AVBox\Shopbybrand\Helper\Page $page,
	    \Magento\Framework\App\Action\Context $context,
	    \Magento\Framework\View\Result\PageFactory $pageFactory)

    {

    $this->_page = $page;
	$this->_pageFactory = $pageFactory;
	return parent::__construct($context);

    }

    public function execute() {

        $pageFactory = $this->_pageFactory->create(); 

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
            ]
        );
	    $pageFactory->getConfig()->getTitle()->set('Forgalmazott márkáink');
	    return $pageFactory;
    }
}
