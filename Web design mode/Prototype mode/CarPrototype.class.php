<?php
/* 此种模式是一种动态创建对象的模式，不再使用new来创建实例，而是通过__clone对象克隆实现
 * 在symfony的AppController类的表单中实现
 * 这种模式是一个抽象父类提供通用属性和方法，子类继承，实现具体化
 */
abstract class CarPrototype{
    protected $model;
    protected $color;
    abstract function __clone();
    function getModel()
    {
        return $this->model;
    }
    function getColor(){
        return $this->color;
    }
    function setColor($colorin){
        $this->color = $colorin;
    }
}
class BMW extends CarPrototype{
    function __construct()
    {
        $this->model = 'BMW';
    }
    function __clone(){

    }
} 
class BYD extends CarPrototype{
    function __construct()
    {
        $this->model = 'BYD';
    }
    function __clone(){

    }
} 