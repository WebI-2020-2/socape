<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedor = new FornecedoresController();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entrada = new EntradasController();

$idfornecedor = intval($_POST['idfornecedor']);

if ($idfornecedor == 0) header("Location: ./entrada.php?msg=1");

try {
    $identrada = $entrada->insert($idfornecedor, 0, date("Y-m-d"));
    header('Location: ./inserirItensEntrada.php?identrada=' . $identrada);
} catch (PDOException $err) {
    echo $err->getMessage();
}
