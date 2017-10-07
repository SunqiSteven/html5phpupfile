<?php
//connect to database by using PDO
$dsn = 'mysql:dbname=app;host=127.0.0.1';
$user= 'root';
$pwd = '';
$pdo = new PDO($dsn,$user,$pwd);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
//解决取出的ID是字符的bug
$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$stmt = $pdo->query('select * from account');
$accounts = $stmt->fetch();
// var_dump($accounts['id']);	
