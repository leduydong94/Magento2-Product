<?php

namespace Product\SampleAttribute\Block;

use Magento\Framework\View\Element\Template;
use  \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Model\ProductRepository;

class Special extends Template
{
    protected $_products;
    protected $_respository;

    public function __construct(
        Template\Context $context,
        CollectionFactory $products,
        ProductRepository $respository
    )
    {
        $this->_products = $products;
        $this->_respository = $respository;
        parent::__construct($context);
    }

    public function GetSpecial(){
        $product = $this->_products->create();
        $special = $product->addAttributeToFilter('is_special', 'Yes');
        return $special;
    }

    public function getProductBySku($sku)
    {
        return $this->_respository->get($sku);
    }
}
