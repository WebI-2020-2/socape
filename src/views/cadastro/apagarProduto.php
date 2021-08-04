<?php

require_once '../../controller/ProdutosController.php';
$produtos = new ProdutosController();

if($_POST) {
    $produtos->delete($_POST['idproduto']);
}