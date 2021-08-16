<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

header('Content-type: application/json');
require_once __DIR__ . '/../../controller/MarcasController.php';
$marca = new MarcasController();

$idmarca = intval($_POST['id']);

if (!$idmarca == 0) {
    $delete = $marca->delete($idmarca);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar uma marca que contenha produtos associados!';

    echo json_encode($delete);
}
