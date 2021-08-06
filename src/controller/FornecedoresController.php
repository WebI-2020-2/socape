<?php

require_once __DIR__ . '/../model/Fornecedor.php';
require_once __DIR__ . '/../model/Database.php';

class FornecedoresController extends Fornecedor
{
    protected $tabela = 'fornecedor';

    public function __construct()
    {
    }

    public function findOne($idfornecedor)
    {
        $query = "SELECT * FROM $this->tabela WHERE idfornecedor = :idfornecedor";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $fornecedor = new Fornecedor(null, null, null, null, null);
            $fornecedor->setIdfornecedor($obj->idfornecedor);
            $fornecedor->setNome($obj->nome);
            $fornecedor->setEndereco($obj->endereco);
            $fornecedor->setTelefone($obj->telefone);
            $fornecedor->setCnpj($obj->cnpj);
        }
        return $fornecedor;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela ORDER BY idfornecedor DESC";
        $stm = Database::prepare($query);
        $stm->execute();
        $fornecedores = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $fornecedores,
                new Fornecedor($obj->idfornecedor, $obj->nome, $obj->endereco, $obj->telefone, $obj->cnpj)
            );
        }
        return $fornecedores;
    }

    public function insert($nome, $endereco, $telefone, $cnpj)
    {
        $query = "INSERT INTO $this->tabela (nome, endereco, telefone, cnpj) VALUES (:nome, :endereco, :telefone, :cnpj)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':endereco', $endereco);
        $stm->bindParam(':telefone', $telefone);
        $stm->bindParam(':cnpj', $cnpj);
        return $stm->execute();
    }

    public function update($idfornecedor, $nome, $endereco, $telefone, $cnpj)
    {
        $query = "UPDATE $this->tabela SET nome = :nome, endereco = :endereco, telefone = :telefone, cnpj = :cnpj WHERE idfornecedor = :idfornecedor";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':endereco', $endereco);
        $stm->bindValue(':telefone', $telefone);
        $stm->bindValue(':cnpj', $cnpj);
        return $stm->execute();
    }

    public function delete($idfornecedor)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE idfornecedor = :idfornecedor";
            $stm = Database::prepare($query);
            $stm->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
