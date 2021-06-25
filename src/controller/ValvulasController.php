<?php

require_once '../../model/Valvulas.php';
require_once '../../model/Database.php';

class ValvulasController extends Valvulas
{
    protected $tabela = 'valvula';

    public function __construct()
    {
    }

    public function findOne($idvalvulas)
    {
        $query = "SELECT * FROM $this->tabela WHERE idvalvulas = :idvalvulas";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvalvulas', $idvalvulas, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $valvula = new Valvulas(null, null);
            $valvula->setIdvalvulas($obj->idvalvulas);
            $valvula->setQuantidade($obj->quantidade);
        }
        return $valvula;  
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $valvulas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $valvulas,
                new Motor($obj->idvalvulas, $obj->quantidade)
            );
        }
        return $valvulas;
    }

    public function insert($quantidade)
    {
        $query = "INSERT INTO $this->tabela (quantidade)
        VALUES (:quantidade)";
        $stm = Database::prepare($query);
        $stm->bindParam(':quantidade', $quantidade);        

        return $stm->execute();
    }

    public function update($idvalvulas)
    {
        $query = "UPDATE $this->tabela SET quantidade = :quantidade WHERE idvalvulas = :idvalvulas";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvalvulas', $idvalvulas, PDO::PARAM_INT);
        $stm->bindValue(':quantidade', $this->getQuantidade());
        
        return $stm->execute();
    }

    public function delete($idmotor)
    {
        $query = "DELETE FROM $this->tabela WHERE idmotor = :idmotor";
        $stm = Database::prepare($query);
        $stm->bindParam(':idmotor', $idmotor, PDO::PARAM_INT);
        return $stm->execute();
    }
    
}
