<?php
    require_once '../../model/Database.php';

    $query = "SELECT * FROM fornecedor";
    $stm = Database::prepare($query);
    $stm->execute();
    
    echo json_encode($stm->fetchAll(PDO::FETCH_ASSOC));
?>