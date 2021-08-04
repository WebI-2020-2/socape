<?php

require_once '../../controller/ValvulasController.php';
$valvulas = new ValvulasController();

if($_POST) {
    $valvulas->delete($_POST['idvalvulas']);
}