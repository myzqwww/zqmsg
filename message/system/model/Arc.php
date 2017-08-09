<?php
/**
 * Created by PhpStorm.
 * User: liu jiehao
 * Date: 2017/8/1
 * Time: 1:23
 */
//命名空间的名称，如果想要调动这个命名空间里面的类利用命名空间的名称可以很快的找到这个类
namespace system\model;

///使用houdunwang\model\Model 这个命名空间，可以调用这个命名空间下的Model类
use houdunwang\model\Model;
//当调用这个类的时候会触发houdunwang\model\Model;命名空间里面的__callStatic 这个方法，会把这个类的名字传过去
class Arc extends Model{

}