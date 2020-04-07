<?php
namespace App\Rpc\Service;
use App\Models\CourseMain;
use App\Models\CourseMetas;
use App\Models\CourseModel;
use App\Rpc\Annotations\CheckParams;
use App\Rpc\Annotations\Logger;
use App\Rpc\Lib\ICourse;
use Swoft\Context\Context;
use Swoft\Rpc\Server\Annotation\Mapping\Service;


/**
 * Class CourseService
 * @package App\Rpc\Service
 * @Service()
 */
class CourseService implements ICourse {

    /**
     * @param $data
     * @return array
     * @Logger
     * @CheckParams(validator="CourseUpdator")
     */
    public function update($data)
    {
        ["course"=>$getCourse,"username"=>$getUser]=$data;
        $ret=CourseMain::batchUpdateByIds($getCourse);
        if($ret && $ret>0){
            return ["result"=>"success"];
        }
        return ["result"=>""];
    }

    public function list($size) {
        return ["list1"];
    }

    public function get($id) {
        /** @var \Swoft\Rpc\Server\Request $req */
        $req = Context::get()->getRequest();
        var_dump($req->getExt());
        $main=CourseMain::find($id);
        $metas=CourseMetas::where("course_id",$id)->get();

        $model=new CourseModel();
        $model->setCourseMain($main);
        $model->setCourseMetas($metas);
        return  $model->toArray();
    }

}