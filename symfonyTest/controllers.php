<?php
/* 专门的控制器脚本：用于处理前端控制器分发路由过来的请求
 *
 * 
 */
use Symfony\Component\HttpFoundation\Response;

function list_action(){
    $post = get_all_posts();//用于处理表单提交的内容从model中获取查询到的所有内容
    $html = render_template("template/list.php",array('posts'=>$post));//这是一个html渲染函数，利用模板将每一个所需要的页面显示，提高可重用性
    return new Response($html);//返回一个页面
}
function show_action($id){
    $post = get_post_by_id($id);//利于id在model脚本中处理查询
    $html = render_template("template/show.php",array('posts'=>$post));
    return new Response($html);
}

function render_template($path,array $args)
{
   extract($args);//将数组中键名作为一个变量，键值作为变量值,上面的实例就是posts变量取值为post的内容
   ob_start();//将输出放入缓存
   require $path;//此处引入template文件中的某个php页面
   $html = ob_get_clean();//将输出缓存输出并清空         
   return $html;
}