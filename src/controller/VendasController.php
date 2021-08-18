<?php

require_once __DIR__ . '/../model/Venda.php';
require_once __DIR__ . '/../model/Database.php';

class VendasController extends Venda
{
    protected $tabela = 'venda';

    public function __construct()
    {
    }

    public function findOne($idvenda)
    {
        $query = "SELECT * FROM $this->tabela WHERE idvenda = :idvenda";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $venda = new Venda(null, null, null, null, null, null);
            $venda->setIdvenda($obj->idvenda);
            $venda->setIdcliente($obj->idcliente);
            $venda->setIdformapagamento($obj->idformapagamento);
            $venda->setData($obj->data);
            $venda->setValortotal($obj->valortotal);
            $venda->setStatus($obj->status);
        }
        return $venda;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela ORDER BY idvenda DESC";
        $stm = Database::prepare($query);
        $stm->execute();
        $vendas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $vendas,
                new Venda($obj->idvenda, $obj->idcliente, $obj->idformapagamento, $obj->data, $obj->valortotal, $obj->status)
            );
        }
        return $vendas;
    }

    public function insert($idcliente, $data, $valortotal)
    {
        $query = "INSERT INTO $this->tabela (idcliente, data, valortotal) VALUES (:idcliente, :data, :valortotal)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente);
        $stm->bindParam(':data', $data);
        $stm->bindParam(':valortotal', $valortotal);
        $stm->execute();

        return Database::lastInsertId();
    }

    public function update($idvenda, $idformapagamento, $status)
    {
        $query = "UPDATE $this->tabela SET idformapagamento = :idformapagamento, status = :status WHERE idvenda = :idvenda";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
        $stm->bindParam(':idformapagamento', $idformapagamento, PDO::PARAM_INT);
        $stm->bindParam(':status', $status, PDO::PARAM_INT);

        return $stm->execute();
    }

    public function delete($idvenda)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE idvenda = :idvenda";
            $stm = Database::prepare($query);
            $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
