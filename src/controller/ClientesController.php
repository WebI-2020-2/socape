<?php

require_once '../../model/Cliente.php';
require_once '../../model/Database.php';

class ClientesController extends Cliente {
    protected $tabela = 'cliente';

    public function __construct() { }

    public function findOne($idcliente) {
        $query = "SELECT * FROM $this->tabela WHERE idcliente = :idcliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        $stm->execute();
        
        foreach ($stm->fetchAll() as $obj) {
            $cliente = new Cliente(null, null, null, null, null, null);
            $cliente->setIdcliente($obj->idcliente);
            $cliente->setNome($obj->nome);
            $cliente->setTelefone($obj->telefone);
            $cliente->setCnpj($obj->cnpj);
            $cliente->setCpf($obj->cpf);
            $cliente->setDebito($obj->debito);
        }
        return $cliente;
    }

    public function findAll() {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $clientes = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $clientes,
                new Cliente($obj->idcliente, $obj->nome, $obj->telefone, $obj->cnpj, $obj->cpf, $obj->debito)
            );
        }
        return $clientes;
    }

    public function insert($nome, $telefone, $cnpj, $cpf, $debito) {
        $query = "INSERT INTO $this->tabela (nome, telefone, cnpj, cpf, debito) VALUES (:nome, :telefone, :cnpj, :cpf, :debito)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':telefone', $telefone);
        $stm->bindParam(':cnpj', $cnpj);
        $stm->bindParam(':cpf', $cpf);
        $stm->bindParam(':debito', $debito);
        return $stm->execute();
    }

    public function update($idcliente) {
        $query = "UPDATE $this->tabela SET nome = :nome, telefone = :telefone, cnpj = :cnpj, cpf = :cpf, debito = :debito WHERE idcliente = :idcliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        $stm->bindValue(':nome', $this->getNome());
        $stm->bindValue(':telefone', $this->getTelefone());
        $stm->bindValue(':cnpj', $this->getCnpj());
        $stm->bindValue(':cpf', $this->getCpf());
        $stm->bindValue(':debito', $this->getDebito());
        return $stm->execute();
    }

    public function delete($idfornecedor) {
        $query = "DELETE FROM $this->tabela WHERE idcliente = :idcliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        return $stm->execute();
    }
}