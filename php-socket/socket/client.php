<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Email: zy943453722@gmail.com
 * Date: 2019/1/9
 * Time: 10:31
 */
$host = "127.0.0.1";
$port = 12345;
$buff = fgets(STDIN);
$buf = "";
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("could not create socket\n");
if (socket_connect($socket,$host,$port) == 0) {
    die("Could not connect server\n");
}
while (1) {
    $buff = $buff."\n";
    socket_send($socket, $buff, 1024, 0);
    socket_recv($socket, $buf, 1024, 0);
    echo $buf."\n";
}
socket_close($socket);