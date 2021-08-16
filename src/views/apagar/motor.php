<?php
session_start();

if(!$_SESSION['logado']) header('Location: ./../../../login.php');

header('Content-type: application/json');
require_once __DIR__ . '/../../controller/MotorController.php';
$motor = new MotorController();

$idmotor = intval($_POST['id']);

if (!$idmotor == 0) {
    $delete = $motor->delete($idmotor);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar uma potência de motor que contenha produtos associados!';

    echo json_encode($delete);
}
