<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/ItensVendaController.php';
$itensvenda = new ItensVendaController();

$iditensvenda = intval($_POST['id']);

if (!$iditensvenda == 0) {
    $delete = $itensvenda->delete($iditensvenda);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar uma entrada que contenha itens inseridos!';

    echo json_encode($delete);
}
