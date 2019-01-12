<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Email: zy943453722@gmail.com
 * Date: 2019/1/9
 * Time: 15:12
 */
include("SmtpMail.php");
$host = "smtp.qq.com";
$port = 25;
$user = "943453722@qq.com";
$pass = "xxxxxxxxxxxx";
$from = "943453722@qq.com";
$to = "1206983959@qq.com";
$subject = "test send";
$content = "This is an example email for you";

$mail = new SmtpMail($host,$port,$user,$pass);
$mail->connect();
$mail->sendEmail($from,$to,$subject,$content);