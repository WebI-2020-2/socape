<?php

require_once __DIR__ . '/../model/Cliente.php';
require_once __DIR__ . '/../model/Database.php';

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
        $query = "SELECT * FROM $this->tabela ORDER BY idcliente DESC";
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

    public function insertPF($nome, $telefone, $cpf, $debito) {
        $query = "INSERT INTO $this->tabela (nome, telefone, cpf, debito) VALUES (:nome, :telefone, :cpf, :debito)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':telefone', $telefone);
        $stm->bindParam(':cpf', $cpf);
        $stm->bindParam(':debito', $debito);
        return $stm->execute();
    }

    public function updatePF($idcliente, $nome, $telefone, $cpf) {
        $query = "UPDATE $this->tabela SET nome = :nome, telefone = :telefone, cpf = :cpf WHERE idcliente = :idcliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':telefone', $telefone);
        $stm->bindValue(':cpf', $cpf);
        return $stm->execute();
    }

    public function insertPJ($nome, $telefone, $cnpj, $debito) {
        $query = "INSERT INTO $this->tabela (nome, telefone, cnpj, debito) VALUES (:nome, :telefone, :cnpj, :debito)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':telefone', $telefone);
        $stm->bindParam(':cnpj', $cnpj);
        $stm->bindParam(':debito', $debito);
        return $stm->execute();
    }

    public function updatePJ($idcliente) {
        $query = "UPDATE $this->tabela SET nome = :nome, telefone = :telefone, cnpj = :cnpj WHERE idcliente = :idcliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        $stm->bindValue(':nome', $this->getNome());
        $stm->bindValue(':telefone', $this->getTelefone());
        $stm->bindValue(':cnpj', $this->getCnpj());
        return $stm->execute();
    }

    public function delete($idcliente) {
        $query = "DELETE FROM $this->tabela WHERE idcliente = :idcliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcliente', $idcliente, PDO::PARAM_INT);
        return $stm->execute();
    }
}