<?php

require_once '../../model/Entrada.php';
require_once '../../model/Database.php';

class EntradasController extends Entrada {
    protected $tabela = 'entrada';

    public function __construct() { }

    public function findOne($identrada) {
        $query = "SELECT * FROM $this->tabela WHERE identrada = :identrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
        $stm->execute();
        
        foreach ($stm->fetchAll() as $obj) {
            $entrada = new Entrada(null, null, null, null);
            $entrada->setIdentrada($obj->identrada);
            $entrada->setIdfornecedor($obj->idfornecedor);
            $entrada->setValortotalnota($obj->valortotalnota);
            $entrada->setDatacompra($obj->datacompra);
        }
        return $entrada;
    }

    public function findAll() {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $entradas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $entradas,
                new Entrada($obj->identrada, $obj->idfornecedor, $obj->valortotalnota, $obj->datacompra)
            );
        }
        return $entradas;
    }
}