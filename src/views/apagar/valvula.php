<?php

require_once '../../controller/ValvulasController.php';
$valvula = new ValvulasController();

if ($_POST) $valvula->delete($_POST['id']);
