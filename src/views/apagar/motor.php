<?php

require_once '../../controller/MotorController.php';
$motor = new MotorController();

if ($_POST) $motor->delete($_POST['id']);
