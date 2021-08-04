<?php

require_once __DIR__ . '/../model/Entrada.php';
require_once __DIR__ . '/../model/Database.php';

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
        $query = "SELECT * FROM $this->tabela ORDER BY datacompra DESC";
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
    public function insert($idfornecedor, $valortotalnota, $datacompra)
    {
        $query = "INSERT INTO $this->tabela (idfornecedor, valortotalnota, datacompra)
        VALUES (:idfornecedor, :valortotalnota, :datacompra)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfornecedor', $idfornecedor);
        $stm->bindParam(':valortotalnota', $valortotalnota);
        $stm->bindParam(':datacompra', $datacompra);

        $stm->execute();
        return Database::lastInsertId();
    }

    public function update($identrada)
    {
        $query = "UPDATE $this->tabela SET idfornecedor = :idfornecedor, valortotalnota = :valortotalnota, datacompra = :datacompra WHERE identrada = :identrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
        $stm->bindValue(':idfornecedor', $this->getIdfornecedor());
        $stm->bindValue(':valortotalnota', $this->getValortotalnota());
        $stm->bindValue(':datacompra', $this->getDatacompra());

        return $stm->execute();
    }

    public function delete($identrada)
    {
        $query = "DELETE FROM $this->tabela WHERE identrada = :identrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
        return $stm->execute();
    }
}