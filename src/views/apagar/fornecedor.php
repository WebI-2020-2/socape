<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedor = new FornecedoresController();

$idfornecedor = intval($_POST['id']);

if (!$idfornecedor == 0) {
    $delete = $fornecedor->delete($idfornecedor);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar um fornecedor que já contenha entradas!';

    echo json_encode($delete);
}
