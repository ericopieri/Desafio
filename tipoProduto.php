<?php
require_once "db.php";

$result = $pdo->query("SELECT * FROM tipo_produto");

$tipos = $result->fetchAll(PDO::FETCH_OBJ);

require_once "headers.php";
echo json_encode($tipos);
