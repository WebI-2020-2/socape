<?php

require_once __DIR__ . '/../model/Fabricacao.php';
require_once __DIR__ . '/../model/Database.php';

class FabricacaoController extends Fabricacao
{
    protected $tabela = 'fabricacao';

    public function __construct()
    {
    }

    public function findOne($idfabricacao)
    {
        $query = "SELECT * FROM $this->tabela WHERE idfabricacao = :idfabricacao";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfabricacao', $idfabricacao, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $fabricacao = new Fabricacao(null, null);
            $fabricacao->setIdfabricacao($obj->idfabricacao);
            $fabricacao->setAno($obj->ano);
        }
        return $fabricacao;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela ORDER BY ano";
        $stm = Database::prepare($query);
        $stm->execute();
        $fabricacoes = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $fabricacoes,
                new Fabricacao($obj->idfabricacao, $obj->ano)
            );
        }
        return $fabricacoes;
    }
    
    public function insert($ano)
    {
        $query = "INSERT INTO $this->tabela (ano)
        VALUES (:ano)";
        $stm = Database::prepare($query);
        $stm->bindParam(':ano', $ano);

        return $stm->execute();
    }

    public function update($idfabricacao, $ano)
    {
        $query = "UPDATE $this->tabela SET ano = :ano WHERE idfabricacao = :idfabricacao";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfabricacao', $idfabricacao, PDO::PARAM_INT);
        $stm->bindValue(':ano', $ano);

        return $stm->execute();
    }

    public function delete($idfabricacao)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE idfabricacao = :idfabricacao";
            $stm = Database::prepare($query);
            $stm->bindParam(':idfabricacao', $idfabricacao, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
