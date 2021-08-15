<?php

require_once __DIR__ . '/../model/FormaPagamento.php';
require_once __DIR__ . '/../model/Database.php';

class FormaPagamentoController extends FormaPagamento
{
    protected $tabela = 'formaPagamento';

    public function __construct()
    {
    }

    public function findOne($idformapagamento)
    {
        $query = "SELECT * FROM $this->tabela WHERE idformapagamento = :idformapagamento";
        $stm = Database::prepare($query);
        $stm->bindParam(':idformapagamento', $idformapagamento, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $formaPagamento = new FormaPagamento(null, null, null);
            $formaPagamento->setIdformapagamento($obj->idformapagamento);
            $formaPagamento->setCondicao($obj->condicao);
            $formaPagamento->setForma($obj->forma);
        }
        return $formaPagamento;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela ORDER BY forma";
        $stm = Database::prepare($query);
        $stm->execute();
        $formaPagamento = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $formaPagamento,
                new FormaPagamento($obj->idformapagamento, $obj->condicao, $obj->forma)
            );
        }
        return $formaPagamento;
    }
    
    public function insert($condicao, $forma)
    {
        $query = "INSERT INTO $this->tabela (condicao, forma)
        VALUES (:condicao, :forma)";
        $stm = Database::prepare($query);
        $stm->bindParam(':condicao', $condicao);
        $stm->bindParam(':forma', $forma);
        return $stm->execute();
    }

    public function update($idformapagamento)
    {
        $query = "UPDATE $this->tabela SET condicao = :condicao, forma = :forma WHERE idformapagamento = :idformapagamento";
        $stm = Database::prepare($query);
        $stm->bindParam(':idformapagamento', $idformapagamento, PDO::PARAM_INT);
        $stm->bindValue(':condicao', $this->getCondicao());
        $stm->bindValue(':forma', $this->getForma());

        return $stm->execute();
    }

    public function delete($idformapagamento)
    {
        $query = "DELETE FROM $this->tabela WHERE idformapagamento = :idformapagamento";
        $stm = Database::prepare($query);
        $stm->bindParam(':idformapagamento', $idformapagamento, PDO::PARAM_INT);
        return $stm->execute();
    }
}
