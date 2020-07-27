<?php

namespace Product\SampleAttribute\Plugin\Model\Checkout\Cart;

//use Magento\Catalog\Model\Product;
use Magento\Checkout\Model\Cart;
use Magento\Framework\Exception\LocalizedException;

class Plugin
{
    public function aroundAddProduct(
        Cart $subject,
        callable $proceed,
        $productInfo,
        $requestInfo = null
    )
    {
        if (null !== $productInfo->getCustomAttribute('is_special')) {
            $productAttribute = $productInfo->getCustomAttribute('is_special')->getValue();
            $productId = $productInfo->getId();
            $items = $subject->getQuote()->getAllItems();
            $cartId = [];
            $attribute = [];
            foreach ($items as $item) {
                $attribute[] = $item->getProduct()->getData('is_special');
                $cartId[] = $item->getProductId();
            }
            if (in_array($productAttribute, $attribute) && $productAttribute == 'Yes' && !in_array($productId, $cartId)) {
                throw new LocalizedException(__('You can only add 1 product is special'));
            } else {
                return $proceed($productInfo, $requestInfo);
            }
        } else {
            return $proceed($productInfo, $requestInfo);
        }
    }
}
