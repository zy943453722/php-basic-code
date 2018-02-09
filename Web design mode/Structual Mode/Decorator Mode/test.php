<?php
/* 装饰器模式：又称为装饰模式，即在一个类中动态添加新行为的设计模式
 * 核心思想：通过使用该模式，可以实现运行时扩充一个类的功能。
 * 增加一个修饰类包裹原来的类，包裹的方式一般是通过在将原来的对象作为修饰类的构造函数的参数。
 * 装饰类实现新的功能，但是，在不需要用到新功能的地方，它可以直接调用原来的类中的方法。
 * 修饰类必须和原来的类有相同的接口。
 * 这种模式，顾名思义是类继承的的另外一种选择。
 */
abstract class Component{
    abstract public function operation();
} 
class MyComponent extends Component{
    public function operation(){
        echo "this is the common method\n";
    }
}
//定义修饰器类
abstract class Decorator extends Component{
    protected $component;
    function __construct(Component $component){//引入原有组件，通过构造函数
        $this->component = $component;
    }
    public function operation(){
        $this->component->operation();//对于需要用到的行为，不采用继承方式，而是采用调用对象方式，调用对象的相应函数
    }
}
class MyDecorator extends Decorator{
    function __construct(Component $component){
        parent::__construct($component);
    }
    public function addMethod(){//继承方式添加行为方法
        echo "this is an add method\n";
    }
    public function operation(){
        $this->addMethod();
        parent::operation();
    }
}
$component = new MyComponent();
$da->operation();
$da = new MyDecorator($component);