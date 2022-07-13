<?php

$Localhost = 'localhost';
$Usuario_BD = 'autowarr_userPol';
$Password_BD = 'Morganas4@';
$Nombre_BD = 'autowarr_polizas';

try{
    $DB_con = new PDO("mysql:host={$Localhost};dbname={$Nombre_BD};charset=UTF8",$Usuario_BD,$Password_BD);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}