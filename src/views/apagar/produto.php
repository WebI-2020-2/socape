<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/ProdutosController.php';
$produto = new ProdutosController();

$idproduto = intval($_POST['id']);

if (!$idproduto == 0) {
    $delete = $produto->delete($idproduto);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar um produto que já contenha entradas/vendas!';

    echo json_encode($delete);
}
