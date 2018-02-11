<?php
/* 享元模式：所谓享元，即共享的元素。又称为轻量级模式，是一种对象结构型模式
 * 核心思想：其核心在于享元工厂类，享元工厂类的作用在于提供一个用于存储享元对象的享元池，
 * 用户需要对象时，首先从享元池中获取，如果享元池中不存在，则创建一个新的享元对象返回给用户，
 * 并在享元池中保存该新增对象。
 * 此模式使用共享物件，用来尽可能减少内存占用，就好像在享元池依次注册用户需要的对象，需要的时候
 * 调用即可，防止因大量重复物件导致的空间占用
 * 
 */
//享元接口
interface Flyweight{
    public function operation();
} 
class MyFlyweight implements Flyweight{
    protected $state;
    function __construct($str){
        $this->state = $str;
    }
    public function operation(){
        echo "myflyweight".$this->state."do operation\n";
    }
}
//享元工厂，包含了独立于享元对象场景的信息，因此可以共享
class FlyweightFactory{
    protected static $flyweightpool;//享元池，存放享元对象
    function __construct(){
        if(!isset(self::$flyweightpool)){
            self::$flyweightpool = [];//若没有这个变量，则创建这个变量
        }
    }
    public function getFlyweight($str){
        if(!array_key_exists($str,self::$flyweightpool)){
            $fw = new MyFlyweight($str);//如果数组中不存在这个键，那么创建一个新的对象
            self::$flyweightpool[$str] = $fw;
            return $fw;
        }else{
            echo "already exist\n";
            return self::$flyweightpool[$str];
        }
    }
} 
$factory = new FlyweightFactory();
$fw = $factory->getFlyweight('zy');
$fw->operation();
$fw = $factory->getFlyweight('zy1');
$fw->operation();
$fw = $factory->getFlyweight('zy2');
$fw->operation();

?>