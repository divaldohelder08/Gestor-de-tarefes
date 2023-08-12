<?php
$host = 'localhost';
$dbname='SoftCode';
$user = 'root';
$password='1234';
$pdo = new PDO("mysql:host=$localhost;dbname=$dbname", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "estou aqui";
?>