<?php
/* 外观模式:又称为门面模式，是一种对象结构型模式 
 * 核心思想：外部客户端与子系统通信，通过一个外观对象提供接口进行通信，所谓的
 * 提供接口通信，就是通过在外观类中定义调用子系统方法的方法，因而客户不需要知道子系统具体有哪些
 * 就可以调用。同时，使得子系统与客户端松耦合，子系统和外部都可以自主运行没有依赖关系。
 */
//创建三个子系统
 class SystemA{
    public function operationA(){
         echo "this is op A\n";
    }
} 
class SystemB{
    public function operationB(){
        echo "this is op B\n";
    }
}
class SystemC{
    public function operationC(){
        echo "this is op C\n";
    }
}
class Facade{
    protected $systemA;
    protected $systemB;
    protected $systemC;
    function __construct(){
        $this->systemA = new systemA;
        $this->systemB = new systemB;
        $this->systemC = new systemC;
    }
    public function myOperation(){
        $this->systemA->operationA();
        $this->systemB->operationB();
        $this->systemC->operationC();
    }
}
$fa = new Facade();
$fa->myOperation();
?>