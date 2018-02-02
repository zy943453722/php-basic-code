<?php
/*此脚本为前端控制器，用于加载核心模块和实现前段路由控制器的匹配
 *主要是对于请求的界面的分发，使得当不满足请求要求时不会出现安全问题
 * 
 */
//包含所有的模型文件和控制器文件
require_once 'vendor/autoload.php';//这是属于自动加载的部分，可自动加载composer.json中autoload的部分

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//$uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);//分离出真正属于PHP_URL_PATH的部分，即根目录下的/index.php/show

$request = Request::createFromGloabals();//初始化请求对象

$uri = $request->getPathInfo();//该方法返回一个清理后的URL

//匹配URL
if($uri === '/'){
   $response = list_action();//选择控制器
}elseif($uri === '/show' && $request->query->has('id')){
   $response = show_action($request->query->get('id'));
}else{
   $html = '<html><body><h1>Page not found</h1></body></html>';
   $response = new Response($html,Response::HTTP_NOT_FOUND);//这就是出现安全问题的界面，没有控制器匹配的情况先要显示404   
}

$response->send();//请求反馈给客户端
?>