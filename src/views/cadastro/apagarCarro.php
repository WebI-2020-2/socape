<?php

require_once '../../controller/CarrosController.php';
$carros = new CarroController();

if($_POST) {
    $carros->delete($_POST['idcarro']);
}