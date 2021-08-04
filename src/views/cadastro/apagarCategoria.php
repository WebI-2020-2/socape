<?php

require_once '../../controller/CategoriaController.php';
$categorias = new CategoriaController();

if($_POST) {
    $categorias->delete($_POST['idcategoria']);
}