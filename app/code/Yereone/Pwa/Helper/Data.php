<?php
namespace Yereone\Pwa\Helper;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Type\Date;
use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getProductLabel($product)
    {
        $date = date_create();
        date_time_set($date,0,0,0);
        $today = date_format($date,"Y-m-d H:i:s");
        if($product->getNewsFromDate() <= $today and $product->getNewsToDate() >= $today) {
            return "new";
        } elseif ($product->getSpecialPrice()) {
            return "sale";
        }
    }
}
