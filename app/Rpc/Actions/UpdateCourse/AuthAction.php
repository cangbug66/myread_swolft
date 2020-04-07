<?php
namespace App\Rpc\Actions\UpdateCourse;

use App\Models\CourseMain;
use App\Models\CourseOwner;
use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointExecution;
use App\Rpc\Service\CourseService;
use Swoft\Aop\Point\ProceedingJoinPoint;

/**
 * Class ParamAction
 * @package App\Rpc\Actions
 * @Aspect(order=2)
 * @PointExecution(include={"CourseService::update"})
 */
class AuthAction{

    public function getAccess(string $username,int $courseid):string {
//        vdump($username,$courseid);
//        $auth_list=CourseOwner::where("course_id",$courseid)
//            ->select("user_name","is_main")->get();
        $auth_list=CourseOwner::where("course_id",$courseid)
            ->select("user_name","is_main")->getModels();
        $result=[0,0];
//        vdump($auth_list);
        /** @var CourseOwner $auth */
        foreach ($auth_list as $auth){
            if($auth->getUserName()===$username){
                $result[0]=1;
                if ($auth->getIsMain()){
                    $result[1]=1;
                }
            }
        }
        /*  00:无权限  10：联合作者  11：主要作者 */
        return implode('',$result);
    }

    /**
     * @Around()
     *
     * @param ProceedingJoinPoint $proceedingJoinPoint
     *
     * @return mixed
     */
    public function around(ProceedingJoinPoint $proceedingJoinPoint)
    {
        // Before around
        $params=$proceedingJoinPoint->getArgs();
//        vdump($params);
        if(!$params || count($params)!=1)
            throw new \Exception("error course param");
        $course=$params[0];
        $username=ext("token.username");
        if(empty($username)) throw new \Exception("error token");
        $access = $this->getAccess($username,$course['item_id']);
        if($access == "00") throw new \Exception("access denied");
        if($access == "10") unset($course["course_price"]);
        $result = $proceedingJoinPoint->proceed([
            ["course"=>$course,"username"=>$username]
        ]);

        // After around

        return $result;
    }
}