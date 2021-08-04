<?php

require_once '../../controller/MotorController.php';
$motores = new MotorController();

if($_POST) {
    $motores->delete($_POST['idmotor']);
}