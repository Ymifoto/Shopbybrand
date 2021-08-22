<?php
namespace AVBox\Shopbybrand\Model;

class TableDeleteBrand {

    protected $page;

    public function __construct(
    
        \AVBox\Shopbybrand\Helper\Page $page
    
    ) {

        $this->_page = $page;

    }

    public function DeleteBrand() {
        
        $datas = array();
        
        $table = $this->_page->getBrandsIDs()->getData();
        
        $attributes = array_column($this->_page->getManufacturerOptionsList(),'value');
         
        foreach ($table as $row) {
            if (!array_search($row['brand_code'],$attributes)) {
                    array_push($datas,array(
                        'id' => $row['id']));
            }    
        }

        foreach ($datas as $data) {
            $post = $this->_page->getModuleTable()->load($data['id']);
            $post->delete();
        }
    }    
}