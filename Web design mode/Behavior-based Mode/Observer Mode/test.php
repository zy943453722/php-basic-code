<?php
/* 观察者模式：又称为发布-订阅模式、模型-视图模式、源-监听器模式或者从属者模式
 * 核心思想：一个目标对象管理所有相依于它的观察者对象，且在其本身发生改变时发出通告。这通常透过呼叫个观察者
 * 所提供的方法实现。实现过程就是当目标状态发生改变，即通知观察者，观察者利用更新函数更新相应的状态。
 * 主要作用：
 * 1.当抽象个体有两个互相依赖的层面时。封装这些层面在单独的对象内将可允许程序员单独地
 * 去变更与重复使用这些对象，而不会产生两者之间交互的问题。
 * 2.当其中一个对象的变更会影响其他对象，却又不知道多少对象必须被同时变更时。
 * 3.当对象应该有能力通知其他对象，又不应该知道其他对象的实做细节时。
 * 
 * 
 */
//抽象观察者类
abstract class Observer{
    abstract function update(Subject $sub);
}
//抽象目标类
abstract class Subject{
    protected static $observers;//提供观察者队列
    function __construct(){
        if(!isset(self::$observers)){
            self::$observers = [];
        }
    }
    public function Attach(Observer $ob){//添加依附的观察者入观察者队列
        if(!in_array($ob,self::$observers)){
            self::$observers[] = $ob;
        }
    }
    public function deattach(Observer $ob){//释放，从观察者队列去除某个观察者
        if(in_array($ob,self::$observers)){
            $key = array_search($ob,self::$observers);//从数组中寻找某个值，返回键
            unset(self::$observers[$key]);//释放某个键
        }
    }
    abstract public function setState($state);
    abstract public function getState();
    public function notify(){//通知函数，利用观察者的更新函数
        foreach(self::$observers as $key => $value){
            $value->update($this);
        }
    }
}
//具体目标，提供了观察者欲追踪的状态，也可设置目标状态
class MySubject extends Subject{
    protected $state;
    public function setState($state){
        $this->state = $state;
    }
    public function getState(){
        return $this->state;
    }
}
//具体观察者类
class MyObserver extends Observer{
    protected $observerName;
    function __construct($name){
        $this->observerName = $name;
    }//设置观察者名称
    public function update(Subject $sub){//利用传入的目标获取一系列信息
        $state = $sub->getState();
        echo "update observer[".$this->observerName."]state:".$state."\n";
    }
}
$subject = new MySubject();
$one = new MyObserver('one');
$two = new MyObserver('two');
$subject->Attach($one);
$subject->Attach($two);
$subject->setState(1);//设置了状态之后通知具体观察者修改状态
$subject->notify();
echo "-------------------\n";
$subject->setState(2);
$subject->deattach($two);
$subject->notify();
?>
