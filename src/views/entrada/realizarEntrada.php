<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedor = new FornecedoresController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entrada = new EntradasController();

$idfornecedor = intval($_POST['idfornecedor']);

if ($idfornecedor == 0) header("Location: ./entrada.php?msg=1");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

try {
    $identrada = $entrada->insert($idfornecedor, date("Y-m-d"));
    header('Location: ./itensEntrada.php?identrada=' . $identrada);
} catch (PDOException $err) {
    echo $err->getMessage();
}
