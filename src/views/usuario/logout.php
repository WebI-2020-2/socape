<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::destroy();

header('Location: ./login.php');
