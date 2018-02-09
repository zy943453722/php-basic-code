<?php
/* 桥接模式：即将事物对象和具体行为具体特征分离开来，使它们可以独立的变化。
 * 核心思想：将抽象化与实现化脱耦，使二者能够独立的变化，具体的来说就是事物都放在事物类的接口下面的具体
 * 类中，行为放在通用行为接口的行为类中，实现对象和行为的分离，继而不必在每个对象中都冗杂的调用行为，而是调用
 * 别的类中对应的方法，提高了效率。
 */
//创建一个通用接口抽象的接口
 interface DrawingAPI{
    public function driwCircle($x,$y,$radius);
} 
//实现定义不同具体行为的接口类，因此可用好多个类去实现上述的通用接口
class DrawAPI1 implements DrawingAPI{
    public function driwCircle($x,$y,$radius){
        echo "API1.circle at (".$x.",".$y.")".$radius."\n"; 
    }
}
class DrawAPI2 implements DrawingAPI{
    public function driwCircle($x,$y,$radius){
        echo "API2.circle at (".$x.",".$y.")".$radius."\n";
    }
}
//桥接器接口，定义通用的行为
interface Shape{
    public function draw();
    public function resize($radius);
}
//定义具体对象实现通用行为的实现
class CircleShape implements Shape{
    private $x;
    private $y;
    private $radius;
    private $drawingAPI;
    function __construct($x,$y,$radius,DrawingAPI $drawingAPI){
           $this->x = $x;
           $this->y = $y;
           $this->radius = $radius;
           $this->drawingAPI = $drawingAPI;
    }
    public function draw(){//调用行为接口中的相应方法，实现行为与对象的分离
        $this->drawingAPI->driwCircle($this->x,$this->y,$this->radius);
    }
    public function resize($radius){
        $this->radius = $radius;
    }
}
$shape1 = new CircleShape(1,2,4,new DrawAPI1());
$shape2 = new CircleShape(1,2,4,new DrawAPI2());
$shape1->draw();
$shape2->draw();
$shape1->resize(10);
$shape1->draw();
?>