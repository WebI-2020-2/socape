<?php
    require_once __DIR__ . '/../../controller/VendasController.php';
    $venda = new VendasController();

    $idcliente = intval($_POST['idcliente']);
    $idformapagamento = intval($_POST['idformapagamento']);

    try {
        $idvenda = $venda->insert($idcliente, $idformapagamento, date("Y-m-d"), 0);
        header("Location: ./inserirItensVenda.php?idvenda=" . $idvenda);

    } catch (PDOException $err) {
        echo $err->getMessage();
    }