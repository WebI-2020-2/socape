<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

header('Content-type: application/json');
require_once __DIR__ . '/../../controller/FabricacaoController.php';
$fabricacao = new FabricacaoController();

$idfabricacao = intval($_POST['id']);

if (!$idfabricacao == 0) {
    $delete = $fabricacao->delete($idfabricacao);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar um ano de fabricação que contenha produtos associados!';

    echo json_encode($delete);
}
