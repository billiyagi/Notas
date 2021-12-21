<?php

$username = 'root';
$password = '';
$db_name = 'notas';
$dsn = "mysql:host=localhost;dbname=$db_name";


try {
     $conn = new PDO($dsn, $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
     echo $e->getMessage();
}
