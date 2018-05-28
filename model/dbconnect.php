<?php 
// MySQLの接続情報



$dsn = 'mysql:dbname=future_news;host=localhost';
$user = 'root';
$SQLpassword = '';
$dbh = new PDO($dsn,$user,$SQLpassword);


$dbh->query('SET NAMES utf8');

// error_log(print_r($dbh,true),"3","../../../../../logs/error_log");//デバッグ
 ?>