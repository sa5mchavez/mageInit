<?php


namespace Pengo\GeoIP\Plugin;

use Magento\Framework\Registry;


class HtmlHeaderPlugin
{
    private $registry;

    public function __construct(Registry $registry)
    {
        $this->registry=$registry;
    }


    public function afterGetWelcome(\Magento\Theme\Block\Html\Header $subject,$result)
    {
        if($this->registry->registry("country_code")){
            $countryCode=$this->registry->registry("country_code");
            return $result.' Your country : '.$countryCode;
        }
        return $result;
    }

}