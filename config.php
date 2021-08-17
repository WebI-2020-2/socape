<?php

$SERVER = '177.38.183.28';
$USER = 'socape';
$PASS = 'socape20181108';
$PORT = '5432';
$DATABASE = 'socape';
define('URLCONNECTION', 'pgsql:host=' . $SERVER . ';port=' . $PORT . ';dbname=' . $DATABASE);
define('USER', $USER);
define('PASS', $PASS);
