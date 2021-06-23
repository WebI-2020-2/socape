<?php

require_once '../../model/Carro.php';
require_once '../../model/Database.php';

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
        $query = "SELECT * FROM $this->tabela";
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
}
