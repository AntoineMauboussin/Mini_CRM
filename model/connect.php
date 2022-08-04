<?php

$host = "localhost";
$user = "root";
$bdd = "minicrm";
$passwd = "";

//variable de connexion à la BDD
$connect = mysqli_connect($host , $user , $passwd, $bdd) or die("erreur de connexion");
$GLOBALS['connect'] = $connect;
?>