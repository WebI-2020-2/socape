<?php

require_once __DIR__ . '/../../controller/EntradasController.php';
$entradas = new EntradasController();

if($_POST) {
    $entradas->delete($_POST['identrada']);
}