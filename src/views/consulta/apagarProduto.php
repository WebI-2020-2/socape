<?php

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

if($_POST) {
    $produtos->delete($_POST['idproduto']);
}