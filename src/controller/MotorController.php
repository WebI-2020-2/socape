<?php

require_once '../../model/Motor.php';
require_once '../../model/Database.php';

class MotorController extends Motor
{
    protected $tabela = 'motor';

    public function __construct()
    {
    }

    public function findOne($idmotor)
    {
        $query = "SELECT * FROM $this->tabela WHERE idmotor = :idmotor";
        $stm = Database::prepare($query);
        $stm->bindParam(':idmotor', $idmotor, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $motor = new Motor(null, null);
            $motor->setIdmotor($obj->idmotor);
            $motor->setPotencia($obj->potencia);
        }
        return $motor;  
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $motores = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $motores,
                new Motor($obj->idmotor, $obj->potencia)
            );
        }
        return $motores;
    }
}
