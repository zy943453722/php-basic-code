<?php
/* 建造者模式：又称为生成器模式，是一种对象构建模式 
 * 核心思想：将复杂对象的构建过程抽象出来，使抽象过程的不同实现方法可以创建出不同属性的对象
 * 1.有个构建对象的基本程式，但至于具体属性，由产品决定
 * 2.有个执行者执行此产品程式创建出产品
 * 3.相应的有个产品类，用于定义产品基本特征和属性
 */
//抽象构建类
abstract class Builder{
    protected $car;
    abstract public function buildPartA();
    abstract public function buildPartB();
    abstract public function buildPartC();
    abstract public function getResult();
}
//具体构建类，用于设置如何生产产品 
class CarBuilder extends Builder{
    function __construct(){
        $this->car = new Car();
    }
    public function buildPartA(){
        $this->car->setPartA('engine');
    }
    public function buildPartB(){
        $this->car->setPartB('wheel');
    }
    public function buildPartC(){
        $this->car->setPartC('other');
    }
    public function getResult(){
        return $this->car;
    }
}
//产品类，指明产品的基本信息
class Car{
    protected $partA;
    protected $partB;
    protected $partC;
    public function setPartA($str){
        $this->partA = $str;
    }
    public function setPartB($str){
        $this->partB = $str;
    }
    public function setPartC($str){
        $this->partC = $str;
    }
    public function show(){
        echo "this car is made up of ".$this->partA."and ".$this->partB." and ".$this->partC."\n";
    }
}
//构建对象的执行者相当于工厂
class Director{
    public $myBuilder;
    public function startBuild(){//执行构建工作
        $this->myBuilder->buildPartA();
        $this->myBuilder->buildPartB();
        $this->myBuilder->buildPartC();
        return $this->myBuilder->getResult();
    }
    public function setBuilder(Builder $builder){//选择构建程式
        $this->myBuilder = $builder;
    }
}
$carBuilder = new CarBuilder();//设置一个执行构建产品的程式
$director = new Director();//创建一个执行产品程式的执行者
$director->setBuilder($carBuilder);
$newCar = $director->startBuild();
$newCar->show();