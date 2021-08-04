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
        $query = "SELECT * FROM $this->tabela ORDER BY marca";
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

    public function update($idmarca)
    {
        $query = "UPDATE $this->tabela SET marca = :marca WHERE idmarca = :idmarca";
        $stm = Database::prepare($query);
        $stm->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);
        $stm->bindValue(':marca', $this->getMarca());
        
        return $stm->execute();
    }

    public function delete($idmarca)
    {
        $query = "DELETE FROM $this->tabela WHERE idmarca = :idmarca";
        $stm = Database::prepare($query);
        $stm->bindParam(':idmarca', $idmarca, PDO::PARAM_INT);
        return $stm->execute();
    }
    
}
