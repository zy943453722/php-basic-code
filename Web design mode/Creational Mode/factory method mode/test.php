<?php
/* 这是工厂方法模式的实例
 * 这种设计模式思想：有一个专门的抽象工厂，有好多具体实现的工厂，用来继承这个抽象工厂所有的生产方式，此时每个对象拥有一个生产工厂。
 * 另外与简单工厂模式不同的是，不需要传递参数来识别何时创建对象，只需要调用某个对象的工厂，即可产出对象，对于
 * 对象的行为，是一类共通的方法，所以用接口定义。
 * 此时若添加一个新对象，不需修改原有的工厂代码，只需要增加/删除具体工厂对象
 */
interface Animal{
   public function run();
   public function say();
}
class Cat implements Animal{//实现接口定义的行为
    public function say(){
        echo "i am cat class\n";
    }
    public function run(){
        echo "i run slowly\n";
    }
}
class Dog implements Animal{
    public function say(){
        echo "i am dog class\n";
    }
    public function run(){
        echo "i run fast\n";
    }
}
abstract class Factory{
    abstract static function creatAnimal(); 
}
class CatFactory extends Factory{
    public static function creatAnimal(){
        return new Cat();
    }
} 
class DogFactory extends Factory{
    public static function creatAnimal(){
        return new Dog();
    }
}
$cat = CatFactory::creatAnimal();
$cat->say();
$cat->run();

$dog = DogFactory::creatAnimal();
$dog->say();
$dog->run();