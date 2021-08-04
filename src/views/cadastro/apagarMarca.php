<?php

require_once '../../controller/MarcasController.php';
$marcas = new MarcasController();

if($_POST) {
    $marcas->delete($_POST['idmarca']);
}