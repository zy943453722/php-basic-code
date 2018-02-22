<?php
/* 中介者模式：即用一个中介对象来封装一系列对象交互，相互通信的两个对象不需要直接交互，通过中介来交互，减少耦合
 * 核心思想：通过此中介者的中转作用，各对象之间不需要显式引用，对象可以一致地和中介者进行交互，
 * 而不需要指明中介者需要具体怎么做，中介者根据封装在自身内部的协调逻辑，对对象的请求进行进一步处理，
 * 将对象成员之间的关系行为进行分离和封装。
 * 操作：通过中介者的对象数组分别注册上需要交互的对象，在通过传递接收者和信息，通过中介者转发给接收方。
 * 
 * 
 */
//抽象同事类
abstract class Colleague{
    protected $mediator;
    abstract public function sendMsg($who,$msg);
    abstract public function receiveMsg($msg);
    public function setMediator(Mediator $mediator){//设置中介者
        $this->mediator = $mediator;
    }
}
//具体同事类 
class ColleagueA extends Colleague{
    public function sendMsg($toWho,$msg){
        echo "send message from A to".$toWho."\n";
        $this->mediator->opreation($toWho,$msg);//这里的mediator早已在注册时就被赋予本身中介者这个对象
    }
    public function receiveMsg($msg){
        echo "A receive msg:".$msg."\n";
    }
}
class ColleagueB extends Colleague{
    public function sendMsg($toWho,$msg){
        echo "send message from B to".$toWho."\n";
        $this->mediator->opreation($toWho,$msg);
    }
    public function receiveMsg($msg){
        echo "B receive msg:".$msg."\n";
    }
}
//抽象中介者
abstract class Mediator{
    abstract public function opreation($id,$mess);
    abstract public function register($id,Colleague $colleague);
}
//具体中介者
class MyMediator extends Mediator{
    protected static $colleagues;
    function __construct(){
        if(!isset(self::$colleagues)){
            self::$colleagues = [];//创建一个对象数组，用于存放注册好的对象
        }
    }
    public function opreation($id,$mess){
        if(!array_key_exists($id,self::$colleagues)){//先看是否注册过此对象，即查看是否包含某个键
            echo "colleague not found\n";
            return;
        }
        $colleague = self::$colleagues[$id];//取出某个对象
        $colleague->receiveMsg($mess);
    }
    public function register($id,Colleague $colleague){
        if(!in_array($colleague,self::$colleagues)){//看是否已存在某个值
            self::$colleagues[$id] = $colleague;//注册
        }
        $colleague->setMediator($this);
    }
}
$colleagueA = new ColleagueA();
$colleagueB = new ColleagueB();
$mediator = new MyMediator();//中介者
$mediator->register(1,$colleagueA);//注册对象1
$mediator->register(2,$colleagueB);//注册对象2
$colleagueA->sendMsg(2,'hello admin');
$colleagueB->sendMsg(1,'hello world');
?>