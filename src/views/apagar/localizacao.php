<?php

require_once '../../controller/LocalizacaoController.php';
$localizacao = new LocalizacaoController();

if ($_POST) $localizacao->delete($_POST['id']);
