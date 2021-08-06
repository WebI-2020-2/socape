<?php

require_once '../../controller/ClientesController.php';
$cliente = new ClientesController();

if ($_POST) $cliente->delete($_POST['id']);
