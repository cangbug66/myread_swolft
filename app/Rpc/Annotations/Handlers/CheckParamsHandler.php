<?php
namespace App\Rpc\Annotations\Handlers;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Aop\Point\JoinPoint;
/**
 * Class CheckParamsHandler
 * @package App\Rpc\Annotations\Handlers
 * @Bean(name="CheckParams")
 */
class CheckParamsHandler implements IHandler{

    function handle($joinPoint, $ret)
    {
        // Before around
        /** @var JoinPoint $joinPoint */
        $params=$joinPoint->getArgs();
//        vdump($params);
        if(!$params || count($params)!=1)
            throw new \Exception("error course param");
        $course=$params[0];
        validate($course,"CourseUpdator");
    }

    function isBefore()
    {
       return true;
    }
}