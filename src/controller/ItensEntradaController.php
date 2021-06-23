<?php

require_once '../../model/ItensEntrada.php';
require_once '../../model/Database.php';

class ItensEntradaController extends ItensEntrada {
    protected $tabela = 'itensEntrada';

    public function __construct() { }

    public function findOne($iditensentrada) {
        $query = "SELECT * FROM $this->tabela WHERE iditensentrada = :iditensentrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':iditensentrada', $iditensentrada, PDO::PARAM_INT);
        $stm->execute();
     
        foreach ($stm->fetchAll() as $obj) {
            $itensEntrada = new ItensEntrada(null, null, null, null, null, null, null, null, null);
            $itensEntrada->setIditensentrada($obj->iditensentrada);
            $itensEntrada->setIdentrada($obj->identrada);
            $itensEntrada->setIdproduto($obj->idproduto);
            $itensEntrada->setPrecocompra($obj->precocompra);
            $itensEntrada->setQuantidade($obj->quantidade);
            $itensEntrada->setUnidade($obj->unidade);
            $itensEntrada->setIpi($obj->ipi);
            $itensEntrada->setFrete($obj->frete);
            $itensEntrada->setIcms($obj->icms);
        }
        return $itensEntrada;
    }

    public function findAll() {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $itensEntradas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $itensEntradas,
                new ItensEntrada($obj->iditensentrada, $obj->identrada, $obj->idproduto, $obj->precocompra, $obj->quantidade, $obj->unidade, $obj->ipi, $obj->frete, $obj->icms)
            );
        }
        return $itensEntradas;
    }
}