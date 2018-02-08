<?php
/* 适配器模式：也可以叫做包装样式wrapper。
 * 基本思想：有些类提供的方法客户端无法直接使用，这时候就需要适配器作为中转站，为用户提供可用的接口，
 * 然后在这些接口中实际调用原有不能直接使用的方法。
 * 优点：将目标类和适配者类解耦，通过引入一个适配器类来重用现有的适配者类，而无须修改原有代码。
 * 增加了类的透明性和复用性，将具体的实现封装在适配者类中，对于客户端类来说是透明的，
 * 而且提高了适配者的复用性。
 */
 class Adaptee{//客户端不可以识别调用的类，由于客户端版本不兼容等问题造成的不兼容问题
     public function realRequest(){
         echo "it's the real method\n";
     }
 }
 interface Target{
     public function request();
 }
 class Adapter implements Target{//适配器类
     protected $adaptee;
     function __construct(Adaptee $adaptee){
         $this->adaptee = $adaptee;
     }
     public function request(){//调用realRequest函数，这个函数是真正客户端可识别的方法
         echo "transform adapter\n";
         $this->adaptee->realRequest();
     }
 }
 $adaptee = new Adaptee();
 $target = new Adapter($adaptee);
 $target->request();//客户端