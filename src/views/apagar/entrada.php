<?php

require_once __DIR__ . '/../../controller/EntradasController.php';
$entrada = new EntradasController();

if ($_POST) $entrada->delete($_POST['id']);
