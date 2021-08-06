<?php

require_once '../../controller/CategoriaController.php';
$categoria = new CategoriaController();

if ($_POST) $categoria->delete($_POST['id']);
