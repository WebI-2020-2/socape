<?php

require_once '../../model/Categoria.php';
require_once '../../model/Database.php';

class CategoriaController extends Categoria
{
    protected $tabela = 'categoria';

    public function __construct()
    {
    }

    public function findOne($idcategoria)
    {
        $query = "SELECT * FROM $this->tabela WHERE idcategoria = :idcategoria";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcategoria', $idcategoria, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $obj) {
            $categoria = new Categoria(null, null, null);
            $categoria->setIdcategoria($obj->idcategoria);
            $categoria->setCategoria($obj->categoria);
        }
        return $categoria;  
    }

    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $categorias = array();

        foreach ($stm->fetchAll() as $obj) {
            array_push(
                $categorias,
                new Categoria($obj->idcategoria, $obj->categoria)
            );
        }
        return $categorias;
    }
}
