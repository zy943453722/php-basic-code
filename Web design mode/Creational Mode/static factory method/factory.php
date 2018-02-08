<?php
/* 这是简单工厂模式的实例
 * 主要思想：根据参数的不同返回不同的类的实例，专门定义一个类来负责生成其他类的实例，被创建的实例均来自此父类，此父类一般称为工厂
 * 以下就是实现创建一个生产动物的工厂，在需要动物的实例时在工厂中创建好，什么时候用什么时候调用   
 * 
 * 
 */
//3个实例
class Cat{
   function __construct(){
       echo "i am cat class\n"; 
   }
}
class Dog{
    function __construct(){
        echo "i am dog class\n";
    }
}
class Mouse{
    function __construct(){
        echo "i am mouse class";
    }
} 
class Factory{
    public static function CreateAnimal($name){//此例的核心，一般定义为静态的，通过不同的参数来相应调用不同的对象
       switch($name){
         case "cat": 
           return new Cat();
         case "dog":
           return new Dog();
         case "Mouse":
           return new Mouse();
         default:
           break;
       }
    }
}
$cat = Factory::CreateAnimal('cat');
$dog = Factory::CreateAnimal('dog');
$mouse = Factory::CreateAnimal('mouse');//这个模式的好处就是将创建对象交给一个工厂去生产，需要时只需要增加删除工厂中的对象即可，避免使用对象时才创建。