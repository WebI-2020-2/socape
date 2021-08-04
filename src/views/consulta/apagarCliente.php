<?php

require_once __DIR__ . '/../../controller/ClientesController.php';
$clientes = new ClientesController();

if($_POST) {
    $clientes->delete($_POST['idcliente']);
}