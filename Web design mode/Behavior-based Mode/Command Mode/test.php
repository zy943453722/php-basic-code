<?php
/* 命令模式：又称为动作模式或事务模式，是一种对象行为型模式
 * 核心思想：将请求(命令)封装成一个对象，分别赋予其接收者和处理方法，不管接受者是谁， 
 * 请求操作是哪个，我们只需要自己创建一个请求接收者，不管真正的接收者是谁，都可以通过该接收者收到
 * 操作，而后进行其他操作的转发。
 * 主要特点就是将一个请求封装为一个对象，从而使我们可用不同的请求对客户进行参数化；
 * 对请求排队或者记录请求日志，以及支持可撤销的操作。
 */ 
//接收者类
 class Receiver{
    public function Action(){
        echo "receiver->action\n";
    }
}
abstract class Command{
    protected $receiver;//在继承的类中也可以使用
    function __construct(Receiver $re){
        $this->receiver = $re;
    }
    abstract public function Execute();
}
class MyCommand extends Command{
    function __construct(Receiver $re){
        parent::__construct($re);//调用父类的构造函数
    }
    public function Execute(){
        $this->receiver->Action();//用抽象类的目的就是把属性也继承使用，而接口不能
    }
}
class Invoker{
    protected $command;
    function __construct(Command $com){
        $this->command = $com;
    }
    public function Invoke(){
        $this->command->Execute();
    }
}
$rece = new Receiver();
//$reces = new Receivers();
$comm = new MyCommand($rece);
//$comms = new MyCommand($reces);
$in = new Invoker($comm);
//$ins = new Invoker($comms);
$in->Invoke();
//$ins->Invoke();
?>