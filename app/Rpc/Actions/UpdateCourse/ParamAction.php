<?php
namespace App\Rpc\Actions\UpdateCourse;

use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointExecution;
use Swoft\Aop\Point\ProceedingJoinPoint;

/**
 * Class ParamAction
 * @package App\Rpc\Actions
 * @Aspect(order=1)
 * @PointExecution(include={"CourseService::update"})
 */
class ParamAction{

    /**
     * @Around()
     *
     * @param ProceedingJoinPoint $proceedingJoinPoint
     *
     * @return mixed
     */
    public function around(ProceedingJoinPoint $proceedingJoinPoint)
    {


        $result = $proceedingJoinPoint->proceed();

        // After around

        return $result;
    }
}