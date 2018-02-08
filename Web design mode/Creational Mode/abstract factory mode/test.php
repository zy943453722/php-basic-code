<?php
/* 抽象工厂模式：又称为kit模式，属于对象创建型模式
 *  核心思想：不同于工厂方法模式，一个具体工厂不再是只生产一种对象，而是生产多个对象产品。
 *  1.一个抽象工厂来定义多种生产技能
 *  2.多个具体品牌工厂具体继承技能生产多种同品牌产品
 *  3.多个产品接口定义产品功能
 *  4.不同品牌产品都实现同一产品接口
 */
interface TV{
    public function open();
    public function watch();
} 
class HaierTv implements TV{
    public function open(){
        echo "hello haierTv\n";
    }
    public function watch(){
        echo "you watch the haierTV\n";
    }
}
class lenovoTV implements TV{
    public function open(){
        echo "hello lenovoTv\n";
    }
    public function watch(){
        echo "you watch the lenovoTV\n";
    }
}
interface PC{
    public function work();
    public function play();
}
class HaierPC implements PC{
    public function work(){
        echo "hello HaierPC\n";
    }
    public function play(){
        echo "let's play haierPC\n";
    }
} 
class LenovoPC implements PC{
    public function work(){
        echo "hello lenovoPC\n";
    }
    public function play(){
        echo "let's play lenovoPC\n";
    }
}
abstract class Factory{//抽象工厂
    abstract public static function createTV();
    abstract public static function createPC(); 
}
class HaierFactory extends Factory{//具体的品牌工厂，不同于工厂方法模式，一个具体工厂可以生产多种产品
    public static function createTV(){
        return new HaierTv();
    }
    public static function createPC(){
        return new HaierPC();
    }
}
class LenovoFactory extends Factory{
    public static function createTV(){
        return new LenovoTv();
    }
    public static function createPC(){
        return new LenovoPC();
    }
}
$name = "haier";
$type = "tv";
if($name === "haier" && $type === "tv"){
    $new = HaierFactory::createTV();
    $new->open();
    $new->watch();
}elseif($name === "haier" && $type === "pc"){
    $new = HaierFactory::createPC();
    $new->work();
    $new->play();
}elseif($name === "lenovo" && $type === "tv"){
    $new = LenovoFactory::createTV();
    $new->open();
    $new->watch();
}else{
    $new = LenovoFactory::createPC();
    $new->work();
    $new->play();
}