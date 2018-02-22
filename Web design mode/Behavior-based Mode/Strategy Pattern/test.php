<?php
/* 策略模式：定义一系列算法，将每一个算法封装起来，使它们可以相互替换，此模式让算法独立于用户变化，又称为政策模式
 * 核心思想：算法很多，若我们需要在一个算法类中提供所有这些算法，这个算法类会非常臃肿且增加删除修改不便，
 * 客户端调用代码也需要改变。而策略模式正是解决这一问题，使得每一种算法依附于一种策略中，而外界环境的变换会调用相应的算法，当算法增加
 * 减少或者修改时只需要修改本身一个类即可，其他代码不用变
 */
//抽象策略类，定义所有支持算法的公共接口
abstract class Strategy{
    abstract function use();
} 
//具体策略类，每一个算法定义一个类
class StrategyA extends Strategy{
    public function use(){
        echo "this is A's method\n";
    }
}
class StrategyB extends Strategy{
    public function use(){
        echo "this is B's method\n";
    }
}
//环境类，使用一个策略对象配置
class Context{
    protected $startegy;
    public function setStrategy(Strategy $startegy){
        $this->startegy = $startegy;
    }
    public function use(){
        $this->startegy->use();//调用对应策略对应的使用函数，即相当于调用算法
    }
}
$context = new Context();
$staA = new StrategyA();
$staB = new StrategyB();
$context->setStrategy($staA);
$context->use();
$context->setStrategy($staB);
$context->use();
?>
