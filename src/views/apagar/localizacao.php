<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/LocalizacaoController.php';
$localizacao = new LocalizacaoController();

$idlocalizacao = intval($_POST['id']);

if (!$idlocalizacao == 0) {
    $delete = $localizacao->delete($idlocalizacao);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar um departamento que contenha produtos associados!';

    echo json_encode($delete);
}
