<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Email: zy943453722@gmail.com
 * Date: 2019/1/9
 * Time: 11:20
 */

/**
 * Class SmtpMail
 * 用php的socket功能连接SMTP服务器并且控制其向指定地址发送邮件
 * 原始的mail函数可以实现，但配置较多，因此用这种类似第三方客户端的方式进行
 */
class SmtpMail
{
    private $host;//目标smtp服务器
    private $port = 25;
    private $user;//用户名
    private $pass;//密码
    private $debug = false;//是否开启调试模式
    private $sock;
    private $mail_format = 0;//标识什么格式发送邮件，0为普通文本，1为HTML邮件

    /**
     * SmtpMail constructor.
     * @param $host
     * @param $port
     * @param $user
     * @param $pass
     * @param int $format
     * @param int $debug
     * 构造函数
     */
    public function __construct($host, $port, $user, $pass, $format=0, $debug=0)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = base64_encode($user);
        $this->pass = base64_encode($pass);
        $this->mail_format = $format;
        $this->debug = $debug;
    }

    /**
     * socket连接smtp服务器函数
     */
    public function connect()
    {
        $this->sock = fsockopen($this->host,$this->port,$errno,$errstr,10);
        if (!$this->sock) {
            exit("Error!\n");
        }
        //获取服务器的响应
        $response = fgets($this->sock);
        $arr = explode(" ",$response);
        if (strcmp($arr[0],220) === false) {
            exit("Server error:$response\n");
        }
    }

    public function showDebug($message)
    {
        if ($this->debug) {
            echo "<p>Debug:$message</p>\n";
        }
    }

    /**
     * @param $cmd
     * @param $return_code
     * @return bool
     * 输入命令的方法
     */
    public function doCommand($cmd,$return_code)
    {
        fwrite($this->sock,$cmd);
        $response = fgets($this->sock);
        echo $response."\n";
        $arr = explode(" ",$response);
        if (strcmp($arr[0],$return_code) === false) {
            $this->showDebug($response);
            return false;
        }
        return true;
    }

    /**
     * @param $email
     * @return bool
     * 判断email地址是否正确
     */
    public function isEmail($email)
    {
        $pattern = "/^[^_][\w]*@[\w.]+[\w]*[^_]$/";
        if (preg_match($pattern,$email,$matches)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $body
     * @return bool
     * 发送email的过程
     */
    public function sendEmail($from,$to,$subject,$body)
    {
        if (!$this->isEmail($from) or !$this->isEmail($to)) {
            $this->showDebug("Please enter vaild from/to email\n");
            return false;
        }

        if (empty($subject) || empty($body)) {
            $this->showDebug("Please enter subject/body\n");
            return false;
        }
        $detail = "From:".$from."\r\n";
        $detail .= "To:".$to."\r\n";
        $detail .= "Subject:".$subject."\r\n";

        if ($this->mail_format == 1) {
            $detail .= "Content-Type:text/html;\r\n";
        } else {
            $detail .= "Content-Type:text/plain;\r\n";
        }

        $detail .= "charset=gb2312\r\n\r\n";
        $detail .= $body;
        //模拟SMTP命令过程
        $this->doCommand("HELO smtp.qq.com\r\n",250);
        $this->doCommand("AUTH LOGIN\r\n",334);
        $this->doCommand($this->user."\r\n",334);
        $this->doCommand($this->pass."\r\n",235);
        $this->doCommand("MAIL FROM:<".$from.">\r\n",250);
        $this->doCommand("RCPT TO:<".$to.">\r\n",250);
        $this->doCommand("DATA\r\n",354);
        $this->doCommand($detail."\r\n.\r\n",250);
        $this->doCommand("QUIT\r\n",221);
        return true;
    }
}