<?php

require_once '../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();

if($_POST) {
    $fornecedores->delete($_POST['idfornecedor']);
}