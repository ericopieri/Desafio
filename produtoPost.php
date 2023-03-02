<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];

    $query = "INSERT INTO produto (nome, valor, tipo) VALUES (?, ?, ?)";
    $insertProduto = $pdo->prepare($query);
    $insertProduto->execute([$nome, $valor, $tipo]);

    if ($insertProduto->rowCount() > 0) {
        echo "Inserção realizada com sucesso!";
    } else {
        $erro = $insertProduto->errorInfo();
        echo "Erro ao inserir o produto: " . $erro[2];
    }
}
