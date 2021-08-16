<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/ItensEntradaController.php';
$itensentrada = new ItensEntradaController();

$iditensentrada = intval($_POST['id']);

if (!$iditensentrada == 0) {
    $delete = $itensentrada->delete($iditensentrada);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar uma entrada que contenha itens inseridos!';

    echo json_encode($delete);
}
