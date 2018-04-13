<?php

namespace Pengo\GeoIP\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\ClientFactory;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\SerializerInterface;

class CaptureCountryObserver implements ObserverInterface
{
    const FREEGEOIP_URL="http://freegeoip.net/json/";

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;
    /**
     * @var ClientFactory
     */
    private $clientFactory;
    /**
     * @var SerializeInterface
     */
    private $serializer;
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
                                RemoteAddress $remoteAddress,
                                ClientFactory $clientFactory,
                                SerializerInterface $serializer,
                                Registry $registry)
    {
        $this->remoteAddress = $remoteAddress;
        $this->clientFactory = $clientFactory->create();
        $this->serializer = $serializer;
        $this->registry = $registry;
    }


    public function execute(Observer $observer)
    {
        if( $this->registry->registry("country_code") ) {

        }

        //$userip = $this->remoteAddress->getRemoteAddress();
        $userip=getenv('HTTP_CLIENT_IP');
        //echo $userip;
        $url = self::FREEGEOIP_URL.$userip;
        //echo '<br>'.$url.'<br>';
        try{
            $this->clientFactory->get($url);
            $response=$this->clientFactory->getBody();
            $data = $this->serializer->unserialize($response);
            //var_dump($data);
        }catch(\Exception $e){
            var_dump($e);
        }
        $county_code = isset($data["country_code"])
                        && $data["country_code"]
                        ? $data["country_code"] : "default";

        if(!$this->registry->registry("country_code")){
            $this->registry->register("country_code",$county_code);
        }
        //die();
    }
}