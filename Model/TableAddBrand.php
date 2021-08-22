<?php
namespace AVBox\Shopbybrand\Model;

class TableAddBrand {

    protected $page;

    public function __construct(
    
        \AVBox\Shopbybrand\Helper\Page $page
    
    ) {

        $this->_page = $page;

    }

    public function AddBrand() {

        $datas = array();
        
        $attributes = $this->_page->getManufacturerOptionsList();

        foreach ($attributes as $row) {
            if (!empty($row['value'])) {
                $verify = $this->_page->getSelectedBrand($row['label']);
                if (empty($verify)) {
                    array_push($datas,array(
                        'brand' => $row['label'],
                        'brand_code' => $row['value'],
                        'meta_key' => strtolower($row['label']),
                        'path' => str_replace(' ','-',strtolower($row['label'])),
                        'active' => 0));
                }    
            }
        }

        foreach ($datas as $data) {
            $table = $this->_page->getModuleTable();
            $table->addData($data)->save();
        }
    }    
}