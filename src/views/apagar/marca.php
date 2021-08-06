<?php

require_once '../../controller/MarcasController.php';
$marca = new MarcasController();

if ($_POST) $marca->delete($_POST['id']);
