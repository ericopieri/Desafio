<?php
require_once "db.php";
require_once "headers.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itens = json_decode($_POST["itens"]);
    $totalPedido = json_decode($_POST["total"]);


    if (is_array($itens)) {
        if (count($itens) > 0) {
            try {
                $pdo->beginTransaction();

                $datetime = date("Y-m-d H:i:s");
                $sqlNovoPedido = $pdo->prepare("INSERT INTO pedido (data, total) VALUES ('$datetime', $totalPedido)");
                $sqlNovoPedido->execute();

                $idPedido = $pdo->lastInsertId();

                foreach ($itens as $item) {
                    $sqlItensPedido = "INSERT INTO produto_pedido (pedido, produto, quantidade, total) VALUES ($idPedido, {$item->produto->codigo}, {$item->quantidade}, {$item->total})";
                    $prepareItensPedido = $pdo->prepare($sqlItensPedido);
                    $prepareItensPedido->execute();
                }

                $pdo->commit();

                echo "Sucesso!";
            } catch (PDOException $err) {
                echo "Error: {$err->getMessage()}";
            }
        }
    }
}
