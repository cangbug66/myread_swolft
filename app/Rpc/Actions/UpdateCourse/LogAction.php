<?php
namespace App\Rpc\Actions\UpdateCourse;

use App\Models\CourseOplog;
use App\Rpc\ServiceLib\OpType;
use Doctrine\Common\Annotations\AnnotationReader;
use Swoft\Aop\Annotation\Mapping\AfterReturning;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointExecution;
use Swoft\Aop\Point\JoinPoint;


/**
 * @Aspect(order=0)
 * @PointExecution(include={"CourseService::update"})
 */
class LogAction{

    /**
     * @AfterReturning()
     *
     * @param JoinPoint $joinPoint
     *
     * @return mixed
     */
    public function afterReturn(JoinPoint $joinPoint)
    {

        $ret = $joinPoint->getReturn();

        // After return

        return $ret;
    }
}