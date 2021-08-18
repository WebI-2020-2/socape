<?php

require_once __DIR__ . '/../model/Marca.php';
require_once __DIR__ . '/../model/Database.php';

class MarcasController extends Marca
{
    protected $tabela = 'marca';

    public function __construct()
    {
    }

    public function findOne($idmarca)
    {
        $query = "SELECT * FROM $this->tabela WHERE idmarca = :idmarca";
        $stm = Database::prepare($query);
        $stm->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $marca = new Marca(null, null);
            $marca->setIdmarca($obj->idmarca);
            $marca->setMarca($obj->marca);
        }
        return $marca;
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela ORDER BY idmarca DESC";
        $stm = Database::prepare($query);
        $stm->execute();
        $marcas = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $marcas,
                new Marca($obj->idmarca, $obj->marca)
            );
        }
        return $marcas;
    }

    public function insert($marca)
    {
        $query = "INSERT INTO $this->tabela (marca)
        VALUES (:marca)";
        $stm = Database::prepare($query);
        $stm->bindParam(':marca', $marca);

        return $stm->execute();
    }

    public function update($idmarca, $marca)
    {
        $query = "UPDATE $this->tabela SET marca = :marca WHERE idmarca = :idmarca";
        $stm = Database::prepare($query);
        $stm->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);
        $stm->bindParam(':marca', $marca);

        return $stm->execute();
    }

    public function delete($idmarca)
    {
        try {
            $query = "DELETE FROM $this->tabela WHERE idmarca = :idmarca";
            $stm = Database::prepare($query);
            $stm->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);
            $stm->execute();

            return array('status' => TRUE);
        } catch (PDOException $e) {
            $arr['status'] = FALSE;
            $arr['code'] = $e->getCode();

            return $arr;
        }
    }
}
