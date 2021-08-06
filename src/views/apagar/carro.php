<?php
header('Content-type: application/json');
require_once __DIR__ . '/../../controller/CarrosController.php';
$carro = new CarroController();

$idcarro = intval($_POST['id']);

if (!$idcarro == 0) {
  $delete = $carro->delete($idcarro);

  if (!$delete['status']) if ($delete['code'] == 23503) $delete['msg'] = 'Não é possível apagar um modelo de carro que já tenha sido associado a um veículo!';

  echo json_encode($delete);
}
