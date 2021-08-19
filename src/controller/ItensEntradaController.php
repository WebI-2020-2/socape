<?php

require_once __DIR__ . '/../model/ItensEntrada.php';
require_once __DIR__ . '/../model/Database.php';

class ItensEntradaController extends ItensEntrada
{
    protected $tabela = 'itensEntrada';

    public function __construct()
    {
    }

    public function findOne($iditensentrada)
    {
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

    public function findAll()
    {
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

    public function findAllByIdEntrada($identrada)
    {
        $query = "SELECT * FROM $this->tabela WHERE identrada = :identrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
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

    public function countItensByIdEntrada($identrada)
    {
        $query = "SELECT SUM(QUANTIDADE) FROM $this->tabela WHERE identrada = :identrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada, PDO::PARAM_INT);
        $stm->execute();

        return intval($stm->fetchColumn());
    }

    public function insert($identrada, $idproduto, $precocompra, $quantidade, $unidade, $ipi, $frete, $icms)
    {
        $query = "INSERT INTO $this->tabela (identrada, idproduto, precocompra, quantidade, unidade, ipi, frete, icms)
        VALUES (:identrada, :idproduto, :precocompra, :quantidade, :unidade, :ipi, :frete, :icms)";
        $stm = Database::prepare($query);
        $stm->bindParam(':identrada', $identrada);
        $stm->bindParam(':idproduto', $idproduto);
        $stm->bindParam(':precocompra', $precocompra);
        $stm->bindParam(':quantidade', $quantidade);
        $stm->bindParam(':unidade', $unidade);
        $stm->bindParam(':ipi', $ipi);
        $stm->bindParam(':frete', $frete);
        $stm->bindParam(':icms', $icms);

        return $stm->execute();
    }

    public function update($iditensentrada)
    {
        $query = "UPDATE $this->tabela SET idproduto = :idproduto, precocompra = :precocompra, quantidade = :quantidade, 
        unidade = :unidade, ipi = :ipi, frete = :frete, icms = :icms WHERE iditensentrada = :iditensentrada";
        $stm = Database::prepare($query);
        $stm->bindParam(':iditensentrada', $iditensentrada, PDO::PARAM_INT);
        $stm->bindParam(':idproduto', $this->getIdproduto());
        $stm->bindParam(':precocompra', $this->getPrecocompra());
        $stm->bindParam(':quantidade', $this->getQuantidade());
        $stm->bindParam(':unidade', $this->getUnidade());
        $stm->bindParam(':ipi', $this->getIpi());
        $stm->bindParam(':frete', $this->getFrete());
        $stm->bindParam(':icms', $this->getIcms());

        return $stm->execute();
    }

    public function delete($iditensentrada)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE iditensentrada = :iditensentrada";
            $stm = Database::prepare($query);
            $stm->bindParam(':iditensentrada', $iditensentrada, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
