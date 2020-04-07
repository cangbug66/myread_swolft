<?php
namespace App\Consul;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Agent;

use Swoft\Consul\Health;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Log\Helper\CLog;
use Swoft\Server\SwooleEvent;
/**
 *
 * @Listener(event=SwooleEvent::START)
 */
class RegService implements EventHandlerInterface{
    /**
     * @Inject()
     *
     * @var Agent
     */
    private $agent;


    /**
     * @Inject()
     *
     * @var Health
     */
    private $health;

    /**
     * @Inject()
     * @var ConsulConfig
     */
    protected $config;

    public function handle(EventInterface $event): void
    {
        $service = [
            'ID'                => $this->config->getServiceId(),
            'Name'              => $this->config->getServiceName(),
            'Tags'              => [
                'course_rpc',
                'gw.NAMESPACE=App.Rpc.Lib',
                "gw.ratelimiter.key=course",
                "gw.ratelimiter.rate=1",
                "gw.ratelimiter.max=2",
                "gw.tokenvalid.ICourse=get",
                "gw.tokenvalid.ICourse=list",
                "gw.tokenvalid.ICourse=update",
            ],
            'Address'           => $this->config->getServiceAddress(),
            'Port'              =>$this->config->getServicePort(),
            'EnableTagOverride' => false,
        ];
        // Register
        $this->agent->registerService($service);
        $this->agent->deregisterService("9133A30B-BE05-41FD-1B29-86C9EBEB28E0");

        $this->agent->registerCheck([
            "name" => $this->config->getServiceId()."_check",
            "tcp" => $this->config->getServiceAddress().":".$this->config->getServicePort(),
            "interval" => "10s",
            "timeout" => "5s",
            "serviceid"=>$this->config->getServiceId()
        ]);
        CLog::info('Swoft rpc register service success by consul!');

    }
}