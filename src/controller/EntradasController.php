<?php

require_once __DIR__ . '/../model/Entrada.php';
require_once __DIR__ . '/../model/Database.php';

class EntradasController extends Entrada
{
    protected $tabela = 'entrada';

    public function __construct()
    {
    }

    public function findOne($identrada)
    {
        $query = "SELECT * FROM $this->tabela WHERE identrada = :identrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $entrada = new Entrada(null, null, null, null, null);
            $entrada->setIdentrada($obj->identrada);
            $entrada->setIdfornecedor($obj->idfornecedor);
            $entrada->setValortotalnota($obj->valortotalnota);
            $entrada->setDatacompra($obj->datacompra);
            $entrada->setStatus($obj->status);
        }
        return $entrada;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela ORDER BY identrada DESC";
        $stm = Database::prepare($query);
        $stm->execute();
        $entradas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $entradas,
                new Entrada($obj->identrada, $obj->idfornecedor, $obj->valortotalnota, $obj->datacompra, $obj->status)
            );
        }
        return $entradas;
    }

    public function insert($idfornecedor, $datacompra)
    {
        $query = "INSERT INTO $this->tabela (idfornecedor, datacompra) VALUES (:idfornecedor, :datacompra)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfornecedor', $idfornecedor);
        $stm->bindParam(':datacompra', $datacompra);
        $stm->execute();

        return Database::lastInsertId();
    }

    public function update($identrada, $status)
    {
        $query = "UPDATE $this->tabela SET status = :status WHERE identrada = :identrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
        $stm->bindParam(':status', $status, PDO::PARAM_INT);

        return $stm->execute();
    }

    public function delete($identrada)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE identrada = :identrada";
            $stm = Database::prepare($query);
            $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
