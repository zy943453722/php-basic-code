<?php
//测试类
include_once('Customer.class.php');
$cus1 = new Customer();
$cus2 = new Customer();
echo "cus1 want to rent the car!\n";
$cus1->rentCar();
echo $cus1->getMakeAndModel();
echo "cus2 want to rent the car!\n";
$cus2->rentCar();
echo $cus2->getMakeAndModel();
$cus1->returnCar();
echo "cus1 return the car\n";
echo "cus2 want to rent the car again!\n";
$cus2->rentCar();
echo $cus2->getMakeAndModel();
?>