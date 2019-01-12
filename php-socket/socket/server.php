<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Email: zy943453722@gmail.com
 * Date: 2019/1/9
 * Time: 10:02
 */
$host = "127.0.0.1";
$port = 12345;
/*socket创建函数，第一个是协议族，现在属于ipv4，
第二个是传输类型(流套接字(tcp)/数据包套接字(udp)...)
第三个则是socket采取何种协议处理
*/
if (($socket = socket_create(AF_INET, SOCK_STREAM, 0)) == 0) {
    die("Could not create socket\n");
}
//绑定函数
if (($res = socket_bind($socket, $host, $port)) == 0) {
    die("Could not bind socket\n");
}
//监听函数,第二个参数为允许的最大连接数
if (($res = socket_listen($socket,3)) == 0) {
    die("Could not listen socket\n");
}
socket_set_block($socket);
while (1) {
    $sock = socket_accept($socket);
    //第二个参数指定读取的长度，但遇到\r或\n时即会停止
    $input = socket_read($sock, 1024);
    $input = trim($input);
    echo $input."\n";
    $output = strrev($input)."\n";//反转数据
    echo $output."\n";
    socket_write($sock, $output, strlen($output));
}
socket_close($sock);
socket_close($socket);