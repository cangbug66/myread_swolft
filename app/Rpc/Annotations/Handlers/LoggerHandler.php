<?php
namespace App\Rpc\Annotations\Handlers;

use App\Models\CourseOplog;
use App\Rpc\ServiceLib\OpType;
use Swoft\Aop\Point\JoinPoint;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class LoggerHandler
 * @package App\Rpc\Annotations\Handlers
 * @Bean(name="Logger")
 */
class LoggerHandler implements IHandler{

    function handle($joinPoint, $ret)
    {
        /** @var JoinPoint $joinPoint */
        $getCourse = $joinPoint->getArgs()[0];
        $getUser = $username = ext("token.username");
//        vdump($ret);
        if($ret && isset($ret["result"]) && $ret["result"]==="success"){
//            vdump("abc");
            sgo(function() use($getCourse,$getUser){
                $oplog=new CourseOplog();
                $oplog->setUserName($getUser);
                $oplog->setAddtime(date('Y-m-d h:i:s'));
                $oplog->setOpComment("更新课程,ID:".$getCourse["item_id"]);
                $oplog->setOpType(OpType::UPDATE);
                $oplog->save();
            });
        }
    }

    function isBefore()
    {
        return false;
    }
}