<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

header('Content-type: application/json');
require_once __DIR__ . '/../../controller/EntradasController.php';
$entrada = new EntradasController();

$identrada = intval($_POST['id']);

if (!$identrada == 0) {
    $delete = $entrada->delete($identrada);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar uma entrada que contenha itens inseridos!';

    echo json_encode($delete);
}
