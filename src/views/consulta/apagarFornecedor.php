<?php

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedor = new FornecedoresController();

if($_POST) {
    $fornecedor->delete($_POST['idfornecedor']);
}