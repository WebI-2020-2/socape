<?php

require_once '../../controller/FabricacaoController.php';
$fabricacao = new FabricacaoController();

if ($_POST) $fabricacao->delete($_POST['id']);
