<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/EntradasController.php';
$entrada = new EntradasController();

$identrada = intval($_POST['identrada']);

try {
    $identrada = $entrada->update($identrada, 1);
    header("Location: ./entrada.php?msg=2");
} catch (PDOException $err) {
    echo $err->getMessage();
}
