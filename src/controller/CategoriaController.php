<?php

require_once __DIR__ . '/../model/Categoria.php';
require_once __DIR__ . '/../model/Database.php';

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
        $query = "SELECT * FROM $this->tabela ORDER BY categoria";
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
    public function insert($categoria)
    {
        $query = "INSERT INTO $this->tabela (categoria)
        VALUES (:categoria)";
        $stm = Database::prepare($query);
        $stm->bindParam(':categoria', $categoria);
        return $stm->execute();
    }

    public function update($idcategoria)
    {
        $query = "UPDATE $this->tabela SET modelo = :modelo WHERE idcategoria = :idcategoria";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcategoria', $idcategoria, PDO::PARAM_INT);
        $stm->bindValue(':categoria', $this->getCategoria());
        return $stm->execute();
    }

    public function delete($idcategoria)
    {
        $query = "DELETE FROM $this->tabela WHERE idcategoria = :idcategoria";
        $stm = Database::prepare($query);
        $stm->bindParam(':idcategoria', $idcategoria, PDO::PARAM_INT);
        return $stm->execute();
    }
}
