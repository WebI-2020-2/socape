<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();

$idvenda = intval($_POST['idvenda']);
$idformapagamento = intval($_POST['idformapagamento']);

try {
    $idvenda = $venda->update($idvenda, $idformapagamento, 1);
    header("Location: ./venda.php?msg=2");
} catch (PDOException $err) {
    echo $err->getMessage();
}
