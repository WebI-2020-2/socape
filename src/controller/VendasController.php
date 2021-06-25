<?php

require_once '../../model/Venda.php';
require_once '../../model/Database.php';

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
        }
        return $venda;  
    }
    
    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $vendas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $vendas,
                new Venda($obj->idvenda, $obj->idcliente, $obj->idformapagamento, $obj->data, $obj->valortotal)
            );
        }
        return $vendas;
    }

    public function insert($idcliente, $idformapagamento, $data, $valortotal)
    {
        $query = "INSERT INTO $this->tabela (idcliente, idformapagamento, data, valortotal)
        VALUES (:idcliente, :idformapagamento, :data, :valortotal)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $quantidade);
        $stm->bindParam(':idformapagamento', $idformapagamento);        
        $stm->bindParam(':data', $data);        
        $stm->bindParam(':valortotal', $valortotal);         

        return $stm->execute();
    }

    public function update($idvenda)
    {
        $query = "UPDATE $this->tabela SET idcliente = :idcliente, idformapagamento = :idformapagamento, data = :data, valortotal = :valortotal WHERE idvenda = :idvenda";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
        $stm->bindValue(':idcliente', $this->getIdcliente());
        $stm->bindValue(':idformapagamento', $this->getIdformapagamento());
        $stm->bindValue(':data', $this->getData());
        $stm->bindValue(':valortotal', $this->getValortotal());
        
        return $stm->execute();
    }

    public function delete($idvenda)
    {
        $query = "DELETE FROM $this->tabela WHERE idvenda = :idvendaidvenda";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvenda', $idvenda, PDO::PARAM_INT);
        return $stm->execute();
    }
    
}
