<?php
/* web设计模式中的Singleton模式：单例模式，确保类只有一个实例，并且这个实例
 * 在全局范围内（调用一个全局可访问的静态函数返回单个实例的引用)可访问。
 * 核心思想：一个类能返回对象一个引用(永远是同一个)和一个获得该实例的方法
 *（必须是静态方法，通常使用getInstance这个名称）；当我们调用这个方法时，如果类持有的引用
 * 不为空就返回这个引用，如果类保持的引用为空就创建该类的实例并将实例的引用赋予该类保持的引用；
 * 同时我们还将该类的构造函数定义为私有方法，这样其他处的代码就无法通过调用该类的构造函数来
 * 实例化该类的对象，只有通过该类提供的静态方法来得到该类的唯一
 * 此类就是一个租车类，承载一个全局静态函数用于检测车是否存在，是否被租，并提供此车的实例
 * 这种模式在symfony的sfGuard类中用到
 */
class CarSingleton{
    private $make = 'Dodge';
    private $model = 'Magnum';
    private static $car = NULL;//检测车是否存在
    private static $isRented = FALSE;//检测车是否被租
    private function __construct()//私有构造函数，防止外界随意创建对象实例
    {

    }
    private function __clone(){}//禁止克隆对象
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
