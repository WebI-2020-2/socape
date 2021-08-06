<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/VendasController.php';
$venda = new VendasController();

$idvenda = intval($_POST['id']);

if (!$idvenda == 0) {
    $delete = $venda->delete($idvenda);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar uma venda que contenha itens inseridos!';

    echo json_encode($delete);
}
