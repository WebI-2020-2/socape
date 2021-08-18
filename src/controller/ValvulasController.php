<?php

require_once __DIR__ . '/../model/Valvulas.php';
require_once __DIR__ . '/../model/Database.php';

class ValvulasController extends Valvulas
{
    protected $tabela = 'valvulas';

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
        $query = "SELECT * FROM $this->tabela ORDER BY quantidade";
        $stm = Database::prepare($query);
        $stm->execute();
        $valvulas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $valvulas,
                new Valvulas($obj->idvalvulas, $obj->quantidade)
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

    public function update($idvalvulas, $quantidade)
    {
        $query = "UPDATE $this->tabela SET quantidade = :quantidade WHERE idvalvulas = :idvalvulas";
        $stm = Database::prepare($query);
        $stm->bindParam(':idvalvulas', $idvalvulas, PDO::PARAM_INT);
        $stm->bindParam(':quantidade', $quantidade);

        return $stm->execute();
    }

    public function delete($idvalvulas)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE idvalvulas = :idvalvulas";
            $stm = Database::prepare($query);
            $stm->bindParam(':idvalvulas', $idvalvulas, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
