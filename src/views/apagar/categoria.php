<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/CategoriaController.php';
$categoria = new CategoriaController();

$idcategoria = intval($_POST['id']);

if (!$idcategoria == 0) {
    $delete = $categoria->delete($idcategoria);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar uma categoria que contenha produtos associados!';

    echo json_encode($delete);
}
