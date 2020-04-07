<?php
namespace App\Consul;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class ConsulConfig
 * @package App\consul
 * @Bean()
 */
class ConsulConfig{
    private $service_id;
    private $service_name;
    private $service_address;
    private $service_port;

    function init(){
        $this->service_id=env("ENV_SERVICE_ID",uuid());
        $this->service_name=env("ENV_SERVICE_NAME","api.myreader.com.course");
        $this->service_address=env("ENV_SERVICE_ADDRESS",serverIP());
        $this->service_port=env("ENV_SERVICE_PORT",28307);
    }

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->service_id;
    }

    /**
     * @return mixed
     */
    public function getServiceName()
    {
        return $this->service_name;
    }

    /**
     * @return mixed
     */
    public function getServiceAddress()
    {
        return $this->service_address;
    }

    /**
     * @return mixed
     */
    public function getServicePort()
    {
        return $this->service_port;
    }


}