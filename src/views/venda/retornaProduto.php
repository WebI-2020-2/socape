<?php
    require_once __DIR__ . '/../../model/Database.php';

    $query = "SELECT p.idproduto, m.marca, c.categoria FROM produto p INNER JOIN marca m ON p.idmarca = m.idmarca INNER JOIN categoria c ON p.idcategoria = c.idcategoria";
    $stm = Database::prepare($query);
    $stm->execute();
    
    echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
?>
