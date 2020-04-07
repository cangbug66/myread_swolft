<?php

use Swoft\Context\Context;

/**
 * Custom global functions
 */

function user_func(): string
{
    return 'hello';
}

function NewProduct(int $pid ,string $pname){
    $p = new stdClass();
    $p->pid=$pid;
    $p->pname=$pname.$pid;
    return $p;

}

function request()
{
    return Swoft\Context\Context::get()->getRequest();
}


function response()
{
    return Swoft\Context\Context::get()->getResponse();
}

function uuid() {
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid=substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12);
    return $uuid;
}
function serverIP(){
    return "192.168.10.10";
    $list=swoole_get_local_ip();
    foreach($list as $key=>$v){  //返回第一个
        return $v ;
        break;
    }
    return "127.0.0.1";
}

//通过token.username.xxx.xx 无限极连获取 ext内容
function ext(string $path,string $default=""){
    /** @var  $req  \Swoft\Rpc\Server\Request */
    $req=Context::get()->getRequest();
    $exts=$req->getExt();
    if(!$exts || count($exts)==0) return $default;
    $pathList=explode(".",$path);
    $getValue=$default;
    foreach ($exts as $ext){
        $getValue=extCore($pathList,$ext,0);
    }
    return $getValue;
}
function extCore(array $pathlist,array $arr,$index=0){
    if($index==(count($pathlist)-1)){
        return isset($arr[$pathlist[$index]])?$arr[$pathlist[$index]]:"";
    }
    if(isset($arr[$pathlist[$index]])){
        return  extCore($pathlist,$arr[$pathlist[$index]], ++$index);
    }else {
        return "";
    }
}

function jsonForObject(array $param,string $class=""){
    try{
        $class_obj=new ReflectionClass($class);//反射对象
        $class_instance=$class_obj->newInstance();//根据反射对象创建实例
        $methods=$class_obj->getMethods(ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method){
            if(preg_match("/^set(\w+)/",$method->getName(),$matches)){
                invokeSetterMethod($matches[1],$class_obj,$param,$class_instance);
            }
        }
        return $class_instance;
    }catch (Exception $exception){
        echo $exception->getMessage();
        return false;
    }
}
function invokeSetterMethod($name,ReflectionClass $class_obj,$jsonMap,&$class_instance){
    //好比 把ProdId 转化成Prod_Id
    $filter_name=strtolower(preg_replace("/(?<=[a-z])([A-Z])/", "_$1",$name));
    //把ProdId 转化成prodId
    $filter_name_ForSwoft=lcfirst($name) ;// ucfirst
    $props=$class_obj->getProperties(ReflectionProperty::IS_PRIVATE);

    foreach ($props as $prop){
        if(strtolower($prop->getName())==$filter_name || $prop->getName()==$filter_name_ForSwoft  ){ //存在对应的私有属性
            $method=$class_obj->getMethod("set".$name);
            $args=$method->getParameters();//取出参数
            if(count($args)==1 && isset($jsonMap[$filter_name])){
                $method->invoke($class_instance,$jsonMap[$filter_name]);
            }

        }
    }
}