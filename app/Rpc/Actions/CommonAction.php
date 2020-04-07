<?php
namespace App\Rpc\Actions;

use App\Rpc\Annotations\Handlers\IHandler;
use Doctrine\Common\Annotations\AnnotationReader;
use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointExecution;
use Swoft\Aop\Point\ProceedingJoinPoint;
use Swoft\Bean\BeanFactory;

/**
 * Class CommonAction
 * @package App\Rpc\Actions
 * @Aspect(order=-999)
 * @PointExecution(include={"CourseService::update"})
 */
class CommonAction{

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @Around()
     */
    public function around(ProceedingJoinPoint $proceedingJoinPoint){
        $ref = new \ReflectionClass($proceedingJoinPoint->getClassName());
        $m = $ref->getMethod($proceedingJoinPoint->getMethod());

        $reader = new AnnotationReader();
        $annos = $reader->getMethodAnnotations($m);
//        vdump($annos);
        $afterBeans=[];
        foreach ($annos as $anno){
            $bean = BeanFactory::getBean($this->getClassName($anno));
            if($bean && is_object($bean) && $bean instanceof IHandler){
                if($bean->isBefore()){
                    $bean->handle($proceedingJoinPoint,false);
                }else{
                    $afterBeans[] = $bean;
                }
            }
        }

        $result = $proceedingJoinPoint->proceed();//最终执行方法
        foreach ($afterBeans as $bean){
            $bean->handle($proceedingJoinPoint,$result);
        }
        return $result;
    }

    private function getClassName(object $obj){
        $arr = explode("\\",get_class($obj));
        return end($arr);
    }
}