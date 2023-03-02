<?php
require_once "db.php";

$result = $pdo->query("SELECT * FROM produto");

$products = $result->fetchAll(PDO::FETCH_OBJ);

foreach ($products as $product) {
    $tipoQuery = "SELECT * FROM tipo_produto as tp WHERE tp.codigo = {$product->tipo}";
    $tipoPrepare = $pdo->prepare($tipoQuery);
    $tipoPrepare->execute();
    $tipo = $tipoPrepare->fetch(PDO::FETCH_OBJ);

    $product->tipo = $tipo;
}


require_once "headers.php";
echo json_encode($products);
