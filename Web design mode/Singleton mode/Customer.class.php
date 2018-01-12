<?php
/* 客户类，用于提供用户交互的需求*/
include_once('CarSingleton.class.php');
class Customer{
    private $rentedCar;
    private $drivesCar = false;
    public function __construct()
    {

    }
    function rentCar()//租车函数
    {
        $this->rentedCar = CarSingleton::rentCar();//利用创建的全局实例来引用一个实例
        if($this->rentedCar == NULL){//车已被租走
           $this->drivesCar = false;//是否租到车
        }
        else{
            $this->drivesCar = true;
        }
    }
    function returnCar(){//还车
        $this->rentedCar->returnCar($this->rentedCar);//将租的车这个实例归还
    }
    public function getMakeAndModel()
    {
        if(true == $this->drivesCar){
            return 'I drive'.$this->rentedCar->getMakeAndModel().' really fast!';
        }
        else{
            return "I can't rent this car.";
        }
    }
}
?>