<?php

require_once '../../model/Fornecedor.php';
require_once '../../model/Database.php';

class FornecedoresController extends Fornecedor {
    protected $tabela = 'fornecedor';

    public function __construct() { }

    public function findOne($idfornecedor) {
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

    public function findAll() {
        $query = "SELECT * FROM $this->tabela order by idfornecedor";
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

    public function insert($nome, $endereco, $telefone, $cnpj) {
        $query = "INSERT INTO $this->tabela (nome, endereco, telefone, cnpj) VALUES (:nome, :endereco, :telefone, :cnpj)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':endereco', $endereco);
        $stm->bindParam(':telefone', $telefone);
        $stm->bindParam(':cnpj', $cnpj);
        return $stm->execute();
    }

    public function update($idfornecedor) {
        $query = "UPDATE $this->tabela SET nome = :nome, endereco = :endereco, telefone = :telefone, cnpj = :cnpj WHERE idcliente = :idcliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);
        $stm->bindValue(':nome', $this->getNome());
        $stm->bindValue(':endereco', $this->getEndereco());
        $stm->bindValue(':telefone', $this->getTelefone());
        $stm->bindValue(':cnpj', $this->getCnpj());
        return $stm->execute();
    }

    public function delete($idfornecedor) {
        $query = "DELETE FROM $this->tabela WHERE idfornecedor = :idfornecedor";
        $stm = Database::prepare($query);
        $stm->bindParam(':idfornecedor', $idfornecedor, PDO::PARAM_INT);
        return $stm->execute();
    }
}