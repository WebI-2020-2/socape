<?php

require_once '../../controller/FornecedoresController.php';
$fornecedor = new FornecedoresController();

if ($_POST) $fornecedor->delete($_POST['id']);
