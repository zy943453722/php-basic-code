<?php
/* web设计模式中的Singleton模式：反模式，确保类只有一个实例，并且这个实例
 * 在全局范围内（调用一个全局可访问的静态函数返回单个实例的引用)可访问。
 * 此类就是一个租车类，承载一个全局静态函数用于检测车是否存在，是否被租，并提供此车的实例
 * 这种模式在symfony的sfGuard类中用到
 */
class CarSingleton{
    private $make = 'Dodge';
    private $model = 'Magnum';
    private static $car = NULL;//检测车是否存在
    private static $isRented = FALSE;//检测车是否被租
    private function __construct()
    {

    }
    public static function rentCar(){
        if(FALSE == self::$isRented){
            if(NULL == self::$car){
                 self::$car = new CarSingleton();//这就相当于设计模式中的对某个实例的引用
            }
            self::$isRented = true;
            return self::$car;//返回对象的引用
        }
        else{
            return NULL;//没有车可租
        }
    }
    public function returnCar(CarSingleton $carReturned)
    {
        self::$isRented = false;
    } 
    function getMake()
    {
        return $this->make;
    }
    function getModel()
    {
        return $this->model;
    }
    function getMakeAndModel()
    {
        return $this->getMake().''.$this->getModel();
    }
}
?>


}
