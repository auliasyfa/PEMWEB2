<?php
 $host = 'localhost';
 $db = 'dbsiak';
 $user = 'root';
 $pass = '';
 $charset = 'utf8mb4';

 // Bat data source name (DSN)
 $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
 $opt = [
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES=>false,
 ];

 $dbh = new PDO($dsn, $user, $pass, $opt);
 ?>