<?php
namespace Product\SampleAttribute\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Product implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $originalName = $product->getName();
        if (null !== $product->getCustomAttribute('is_special')) {
            if ($product->getCustomAttribute('is_special')->getValue() == 'Yes') {
                $modifiedName = $originalName . ' - Special Promotion';
                $product->setName($modifiedName);
            }
        }
    }
}
