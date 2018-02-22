<?php
/* 状态模式：允许一个对象在其内部状态改变时改变其行为。 是一种对象行为型模式。
 * 有时，一个对象的行为受其一个或多个具体的属性变化而变化，这样的属性也叫作状态，
 * 这样的的对象也叫作有状态的对象。
 * 过程：某个有状态的对象其属性（状态)本身的变化会带来行为的变化，因此，状态本身创建成一个类， 
 * 每一种状态对应一种处理函数，当有状态的对象的状态发生转变，即调用相应状态的处理函数(行为)
 * 
 * 
 */ 
//环境类
 class Context{//有状态的对象
    protected $state;//状态
    function __construct()
    {
        $this->state = StateA::getInstance();
    }
    public function changeState(State $state)
    {
        $this->state = $state;
    }
  
    public function request()//行为
    {
        $this->state->handle($this);
    }
  }
  //抽象状态类
  abstract class State{
    abstract function handle(Context $context);//对应一个特定状态采取一定的行为措施
  }
  //具体状态类
  class StateA extends State
  {
    private static $instance;
    private function __construct(){}
    private function __clone(){}//禁止外部对象引用
  
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
  
    public function handle(Context $context)
    {
        echo "doing something in State A.\n done,change state to B\n";
        $context->changeState(StateB::getInstance());//改变状态到B
    }
  }
  class StateB extends State
  {
    private static $instance;
    private function __construct(){}
    private function __clone(){}
  
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }
  
    public function handle(Context $context)
    {
        echo "doing something in State B.\n done,change state to A \n";
        $context->changeState(StateA::getInstance());
    }
  }
  
  $context = new Context();
  $context->request();
  $context->request();
  $context->request();
  $context->request();
?>