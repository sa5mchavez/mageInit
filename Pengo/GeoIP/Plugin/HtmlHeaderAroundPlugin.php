<?php


namespace Pengo\GeoIP\Plugin;

use Magento\Framework\Registry;
use Magento\Theme\Block\Html\Header;

class HtmlHeaderAroundPlugin
{
    public function __construct(Registry $registry)
    {
        $this->registry=$registry;
    }

    public function aroundGetWelcome(Header $subject,callable $proceed){
        if($this->registry->registry('country_code') == 'MX'){
            $result = __('Buuuu, you\'re living in Mexico');
        }
    }

}