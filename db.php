<?php

$servername = "localhost:3306";
$username = "root";
$password = "111111";
$dbname = "desafio";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die("Erro na conexão com o banco de dados: " . $err->getMessage());
}