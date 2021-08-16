<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

header('Content-type: application/json');
require_once __DIR__ . '/../../controller/ClientesController.php';
$cliente = new ClientesController();

$idcliente = intval($_POST['id']);

if (!$idcliente == 0) {
    $delete = $cliente->delete($idcliente);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar um cliente que já contenha vendas!';

    echo json_encode($delete);
}
