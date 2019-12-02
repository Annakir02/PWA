<?php
namespace Yereone\Megamenu\Observer;

class AddCategoryTopMenu implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $transportObject = $observer->getData('transportObject');
        $menuHtml = '<li class="level0 nav-0 category-item zero level-top ui-menu-item"><a href="#" class="level-top ui-corner-all" ><span>' . __("HOME") . '</span></a></li>' . $transportObject->getHtml() .
            '<li class="level0 nav-4 category-item forth level-top ui-menu-item"><a href="#" class="level-top ui-corner-all" ><span>' .  __("ABOUT US") . '</span></a></li>' .
            '<li class="level0 nav-5 category-item fifth level-top ui-menu-item"><a href="#" class="level-top ui-corner-all" ><span>' . __("CONTACT US") . '</span></a></li>';
        $transportObject->setData('html', $menuHtml);

        return $this;
    }
}