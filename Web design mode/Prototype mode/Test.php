<?php
/*测试类*/
include_once('CarPrototype.class.php');
$bmw = new BMW();
$byd = new BYD();
$choose = 1;
if($choose == 1){
    $car = clone $bmw;
}
else{
    $car = clone $byd;
}
echo $car->getModel()."\n";
echo $car->setColor('red');
echo $car->getColor()."\n";