<?php
/* 代理者模式：所谓代理者就是一个类别可以做其他东西的接口，起到中介的作用 
 * 核心思想：代理者可以做任何东西的接口，尤其是极其重要的不需要客户知道，需要过滤的消息，用户通过 
 * 访问代理者，进而访问实际的对象，但并不是实际对象中的所有信息都在代理中，代理只是调用一部分用户
 * 可以知晓的信息，屏蔽不可以知晓的，归根结底就是通过第三方代理者访问实际的对象。
 * 
 */
interface Subject{
    public function requests();
}
//真实对象类 
class RealSubject implements Subject{
    public function requests(){
       echo "RealSubject::request\n";
    }
}
//代理类
class Proxy implements Subject{
    protected $realSubject;
    function __construct(){
        $this->realSubject = new RealSubject();
    }
    public function beforeRequest(){
        echo "proxy::beforeRequest\n";
    }
    public function requests(){
        $this->beforeRequest();
        $this->realSubject->requests();
        $this->afterRequest();
    }
    public function afterRequest(){
        echo "Proxy::afterRequest\n";
    }
}
$proxy = new Proxy();
$proxy->requests();
?>
