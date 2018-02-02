<?php
/* 这是模型层的脚本，此处实现的功能主要是与数据库的交互
 * 返回的信息供相应的控制器使用
 * 
 */
function open_database_connection()//控制数据库的连接
{
    $user = "root";
    $passwd = "826451379";
    $link = new PDO("mysql:host=localhost;dbname=Cars",$user,$passwd);
    return $link;
}
function close_database_connection($link)//控制数据库的关闭
{
    $link = null;
}
function get_all_post()//显示的主页主要的
{
  $link = open_database_connection();
  $result = $link->query('select Car_num,Car_logo from car_info');
  $posts = array();
  while($row = $result->fetch(PDO::FETCH_ASSOC)){//将结果的每一行按列存放成数组的形式
      $posts[] = $row;
  }
  close_database_connection($link);
}
function get_post_by_id($id)
{
    $link = open_database_connection();
    $sql = "select * from car_info where Car_date = :Car_date";
    $statement = $link->prepare($sql);//准备好sql语句
    $statement->bindValue(':Car_date',$id,PDO::PARAM_INT);
    $statement->execute();//处理预定义sql语句的查询
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    close_database_connection($link);
    return $row;
}