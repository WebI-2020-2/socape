<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();

$idformapagamento = intval($_POST['idformapagamento']);
$idcliente = intval($_POST['idcliente']);

if ($idformapagamento == 0) header("Location: ./venda.php?msg=1");
if ($idcliente == 0) header("Location: ./venda.php?msg=2");

try {
    $idvenda = $venda->insert($idcliente, $idformapagamento, date("Y-m-d"), 0);
    header("Location: ./inserirItensVenda.php?idvenda=" . $idvenda);
} catch (PDOException $err) {
    echo $err->getMessage();
}
