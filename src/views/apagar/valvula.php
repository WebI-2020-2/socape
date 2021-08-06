<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/ValvulasController.php';
$valvula = new ValvulasController();

$idvalvula = intval($_POST['id']);

if (!$idvalvula == 0) {
    $delete = $valvula->delete($idvalvula);

    if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar a quantidade de válvulas que está associada a produtos!';

    echo json_encode($delete);
}
