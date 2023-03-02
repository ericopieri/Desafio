<?php
require_once "db.php";
require "headers.php";


$prepareVendas = $pdo->prepare("SELECT * FROM pedido");
$prepareVendas->execute();
$pedidos = $prepareVendas->fetchAll(PDO::FETCH_OBJ);

foreach ($pedidos as $pedido) {
    $prepareItensVenda = $pdo->prepare("SELECT * FROM produto_pedido WHERE produto_pedido.pedido = {$pedido->codigo}");
    $prepareItensVenda->execute();

    $itensVenda = $prepareItensVenda->fetchAll(PDO::FETCH_OBJ);

    foreach ($itensVenda as $itemVenda) {
        $prepareProduto = $pdo->prepare("SELECT * FROM produto WHERE produto.codigo = {$itemVenda->produto}");
        $prepareProduto->execute();

        $produto = $prepareProduto->fetch(PDO::FETCH_OBJ);
        $itemVenda->produto = $produto;
    }

    $pedido->itens = $itensVenda;
}

echo json_encode($pedidos);
