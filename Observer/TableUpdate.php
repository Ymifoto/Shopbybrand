<?php

namespace AVBox\Shopbybrand\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class TableUpdate implements ObserverInterface {

    protected $page;
    protected $_logger;

    public function __construct(
        \AVBox\Shopbybrand\Helper\Page $page,
        \Psr\Log\LoggerInterface $logger
    )
    {        
        $this->_page = $page;
        $this->_logger = $logger;
    }

    public function execute(Observer $observer) {
    	
        $attrCode = $observer->getEvent()->getAttribute()->getAttributeCode();

        $tabledata = $this->_page->getModuleTableCollection()
                                    ->addFieldToFilter('brand_code',['neq'=>0])
                                    ->addFieldToSelect('brand')
                                    ->addFieldToSelect('id')
                                    ->getData();

        if ($attrCode == 'manufacturer') {
            $attributes = $this->_page->getManufacturerOptionsList();
            
            foreach ($tabledata as $row) {
                if (!array_search($row['brand'],array_column($attributes,'label'))) {
                $this->deleteBrand($row);
                }
            }

            foreach ($attributes as $row) {

              if (!empty($row['value'])) {

                if (!in_array($row['label'],array_column($tabledata,'brand'))) {
  
                    $datas = array(
                        'brand' => $row['label'],
                        'brand_code' => $row['value'],
                        'meta_key' => strtolower($row['label']),
                        'path' => str_replace(' ','-',strtolower($row['label'])),
                        'active' => 0);

                        $this->addBrand($datas);
                    }
                }
            }
        }
	}

    private function deleteBrand($data) {

        $table = $this->_page->getModuleTable()->load($data['id']);
        $table->delete();
        $this->_logger->info('Gyártó törölve: ' . $data['brand']);
    }

    private function addBrand($datas) {

        $table = $this->_page->getModuleTable();
        $table->addData($datas)->save();
        $this->_logger->info('Gyártó hozzáadva: ' . $datas['brand']);
    }
}