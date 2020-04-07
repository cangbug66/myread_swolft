<?php
namespace App\Consul;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Agent;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Server\SwooleEvent;
/**
 *
 * @Listener(SwooleEvent::SHUTDOWN)
 */
class UnregService implements EventHandlerInterface
{
    /**
         * @Inject()
         *
         * @var Agent
     */
    private $agent;

    /**
     * @Inject()
     * @var ConsulConfig
     */
    protected $config;
    public function handle(EventInterface $event): void
    {
        $this->agent->deregisterService($this->config->getServiceId());
    }
}