<?php

require_once '../../controller/ClientesController.php';
$clientes = new ClientesController();

if($_POST) {
    $clientes->delete($_POST['idcliente']);
}