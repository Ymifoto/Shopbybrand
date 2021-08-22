<?php
namespace AVBox\Shopbybrand\Controller;
 
class Router implements \Magento\Framework\App\RouterInterface
{

    protected $actionFactory;
    protected $_response;
    protected $page;
 
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\ResponseInterface $response,
	    \AVBox\Shopbybrand\Helper\Page $page
    ) {
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
	    $this->_page = $page;
    }
 
    public function match(\Magento\Framework\App\RequestInterface $request) {

        $identifier = trim($request->getPathInfo(), '/');

	    $pathlist = $this -> getBrandsPathList();
	//var_dump($identifier);

	    if ($identifier == $this->getBrandsPage()[0]['path']) {
    	    $request->setModuleName('brands')
	                ->setControllerName('index')
	                ->setActionName('index');
	    }
        elseif (array_search($identifier, $pathlist)){

            $request->setModuleName('brands')
		            ->setControllerName('brand')
		            ->setActionName('index')
		            ->setParam('brand', str_replace($this->getBrandsPage()[0]['path'] . '/', '', $identifier));
	    }
	    else {
            //There is no match
            return;
        }
 
        return $this->actionFactory->create('Magento\Framework\App\Action\Forward',['request' => $request]);
    }

    private function getPathList() {

        return $this->_page->getModuleTableCollection()
                           ->addFieldToFilter('active',['eq'=> 1])
                           ->addFieldToFilter('brand_code',['neq'=> 0])
                           ->addFieldToSelect('path')                           
                           ->getData();
    }

    private function getBrandsPage() {

        return $this->_page->getBrandsPagePath();
    }
    
    private function getBrandsPathList() {

	    $path = $this->getPathList();
	    $urlpath = array();
        
	    foreach ($path as $row) {
	            array_push($urlpath, $this->getBrandsPage()[0]['path'] . '/' . $row['path']);
	    }
	    return $urlpath;
    }
}
