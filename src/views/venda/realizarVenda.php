<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();

$idcliente = intval($_POST['idcliente']);

if ($idcliente == 0) header("Location: ./venda.php?msg=1");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

try {
    $idvenda = $venda->insert($idcliente, date("Y-m-d"));
    header("Location: ./itensVenda.php?idvenda=" . $idvenda);
} catch (PDOException $err) {
    echo $err->getMessage();
}
