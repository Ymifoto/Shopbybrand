<?php
namespace AVBox\Shopbybrand\Cron;

class Tableupdate {

    protected $page;
    protected $data;

    public function __construct(
    
        \AVBox\Shopbybrand\Helper\Page $page,
        \AVBox\Shopbybrand\Helper\Data $data
    
    ) {

        $this->_page = $page;
        $this->_data = $data;

    }

    public function execute() {
        
        $brands = $this->getCollection();
        $tabledata = $this->_page->getBrandsIDs();
        $table = $this->_page->getModuleTable();
        
        
        foreach ($tabledata as $row) {
            
            if (array_key_exists($row['brand_code'],$brands)) {
                $data = array('count'=> $brands[$row['brand_code']]);
                $table->load($row['id']);
                $table->setData($data);
                $table->save();

            }
        }
    }

    private function getCollection() {
        
        $productlist = $this->_data->getProductCollection()
        ->addAttributeToFilter('status', array('eq' => 1))
	    ->addAttributeToSelect('manufacturer')
	    ->getData();

        return array_count_values(array_column($productlist,'manufacturer'));
    }
}