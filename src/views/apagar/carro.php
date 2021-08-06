<?php

require_once '../../controller/CarrosController.php';
$carro = new CarroController();

if ($_POST) $carro->delete($_POST['id']);
