<?php
require_once "db.php";
require_once "headers.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];

    $insertProduto = $pdo->prepare("INSERT INTO produto (nome, valor, tipo) VALUES ('$nome', '$valor', '$tipo')");
    $insertProduto->execute();

    if ($insertProduto->rowCount() > 0) {
        require_once "produtos.php";
    } else {
        $erro = $insertProduto->errorInfo();
        echo "Erro ao inserir o produto: " . $erro[2];
    }
}
