<?php
/**
 * Created by PhpStorm.
 * User: liu jiehao
 * Date: 2017/7/31
 * Time: 20:42
 */
//命名空间的名称，如果想要调动这个命名空间里面的类利用命名空间的名称可以很快的找到这个类
namespace app\home\controller;
//使用houdunwang\core\Controller 这个命名空间，可以继承这个命名空间下的Controller类
use houdunwang\core\Controller;
//使用houdunwang\view\View 这个命名空间，可以调用这个命名空间下的View类
use houdunwang\view\View;
//使用system\model\Arc; 这个命名空间，可以调用这个命名空间下的Arc类
use system\model\Arc;
//使用Gregwar\Captcha\CaptchaBuilder; 这个命名空间，可以调用这个命名空间下的Arc类
use Gregwar\Captcha\CaptchaBuilder;

/**
 * Class Entry 默认执行的类
 * @package app\home\controller
 */

class Entry extends Controller{
//    创建方法：用来实现显示首页和添加功能
    public function index(){
//        获得文章表的所有数据
//        在默认的首页中把文章表的数据循环出来
        $arcData = Arc::get();

//        添加内容
//        判断：当用户点击了提交并且使用的是post的方式提交就是执行大括号里面的代码
        if(IS_POST){
//            判断输入的验证码是否与验证码相同个，如果不相同就会提示用户输入错误并且跳出这个函数不在执行后面的代码
            if(strtolower($_POST['captcha']) != strtolower($_SESSION['phrase'])){
                return $this->error('验证码错误');
            }
//            调用Arc里面的save方法，并且把表单收集过来的数据传参过去
//            save这个方法用来实现数据的保存功能
            Arc::save($_POST);
//            提示用户添加成功并且页面跳转到首页
//            最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
            return $this->success("添加成功")->setRedirect("index.php");
        }

//        $data这个数组需要返回到首页，所以需要传参到View方法里面与模板的路径一起返回来
//        make方法里组合模板的路径--最终返回的是make方法当前的Base类
//        with方法会把我们需要的值给返回来--最终返回的是with方法当前的Base类
//        make方法和with方法最终会返回到Boot，被echo输出是来，触发__toString这个方法，这个方法会加载make方法里组合的路径并且把需要返回的值返回过来
        return View::make()->with(compact("arcData"));
    }

//    创建方法：实现删除的功能
    public function remove(){
//        静态调用Arc
//        传入删除的文件的where条件，并且删除这条数据
        Arc::where("aid={$_GET["aid"]}")->del();
//            提示用户添加成功并且页面跳转到首页
//            最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
        return $this->success('删除成功')->setRedirect('index.php');
    }

//        创建方法：用来实现修改功能
    public function update(){
//        用一个变量存着用户点击的相对应的需要修改的数据的aid
        $aid = $_GET['aid'];
//        判断用户是否用了post的方法提交数据
//        如果使用post方法提交的数据就会执行大括号里面的代码，否则不执行
        if(IS_POST){
//        静态调用Arc
//        传入替换的文件的where条件，并且修改这条数据
            Arc::where("aid={$aid}")->update($_POST);
//            提示用户添加成功并且页面跳转到首页
//            最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
            return $this->success('修改成功')->setRedirect('index.php');
        }
//        获得就数据，在页面把修改前的数据显示出来
        $oldData = Arc::find($aid);
//        $data这个数组需要返回到首页，所以需要传参到View方法里面与模板的路径一起返回来
//        make方法里组合模板的路径--最终返回的是make方法当前的Base类
//        with方法会把我们需要的值给返回来--最终返回的是with方法当前的Base类
//        make方法和with方法最终会返回到Boot，被echo输出是来，触发__toString这个方法，这个方法会加载make方法里组合的路径并且把需要返回的值返回过来
        return View::make()->with(compact('oldData'));
    }

//    创建方法：显示验证码的功能
    public function captcha(){
//        加载显示验证码的头部
        header('Content-type: image/jpeg');
//        实例化验证码的类
        $builder = new CaptchaBuilder();
//        创建验证码
        $builder->build();
//        输出验证码
        $builder->output();
        //把值存入到session，便于验证码的匹配
        $_SESSION['phrase'] = $builder->getPhrase();
    }




}