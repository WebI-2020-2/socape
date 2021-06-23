<?php

require_once '../../model/Localizacao.php';
require_once '../../model/Database.php';

class LocalizacaoController extends Localizacao
{
    protected $tabela = 'localizacao';

    public function __construct()
    {
    }

    public function findOne($idlocalizacao)
    {
        $query = "SELECT * FROM $this->tabela WHERE idlocalizacao = :idlocalizacao";
        $stm = Database::prepare($query);
        $stm->bindParam(':idlocalizacao', $idlocalizacao, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $localizacao = new Localizacao(null, null);
            $localizacao->setIdlocalizacao($obj->idlocalizacao);
            $localizacao->setDepartamento($obj->departamento);
        }
        return $localizacao;  
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $localizacoes = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $localizacoes,
                new Localizacao($obj->idlocalizacao, $obj->departamento)
            );
        }
        return $localizacoes;
    }
}
