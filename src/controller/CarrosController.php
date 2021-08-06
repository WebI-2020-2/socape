<?php

require_once __DIR__ . '/../model/Carro.php';
require_once __DIR__ . '/../model/Database.php';

class CarroController extends Carro
{
    protected $tabela = 'carro';

    public function __construct()
    {
    }

    public function findOne($idcarro)
    {
        $query = "SELECT * FROM $this->tabela WHERE idcarro = :idcarro";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcarro', $idcarro, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $carro = new Carro(null, null, null);
            $carro->setIdcarro($obj->idcarro);
            $carro->setModelo($obj->modelo);
        }
        return $carro;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela ORDER BY idcarro DESC ";
        $stm = Database::prepare($query);
        $stm->execute();
        $carros = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $carros,
                new Carro($obj->idcarro, $obj->modelo)
            );
        }
        return $carros;
    }
    public function insert($modelo)
    {
        $query = "INSERT INTO $this->tabela (modelo)
        VALUES (:modelo)";
        $stm = Database::prepare($query);
        $stm->bindParam(':modelo', $modelo);
        return $stm->execute();
    }

    public function update($idcarro)
    {
        $query = "UPDATE $this->tabela SET modelo = :modelo WHERE idcarro = :idcarro";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcarro', $idcarro, PDO::PARAM_INT);
        $stm->bindValue(':modelo', $this->getModelo());
        return $stm->execute();
    }

    public function delete($idcarro)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE idcarro = :idcarro";
            $stm = Database::prepare($query);
            $stm->bindParam(':idcarro', $idcarro, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
