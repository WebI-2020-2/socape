<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();

$idcliente = intval($_POST['idcliente']);

if ($idcliente == 0) header("Location: ./venda.php?msg=1");

try {
    $idvenda = $venda->insert($idcliente, date("Y-m-d"), 0);
    header("Location: ./inserirItensVenda.php?idvenda=" . $idvenda);
} catch (PDOException $err) {
    echo $err->getMessage();
}
