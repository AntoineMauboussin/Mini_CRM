<?php
require_once '../model/connect.php';
require_once '../model/contact.php';

if(!isset($_POST["phone"])){
    $contact = new Contact($_GET["id"],$_POST["firstname"],$_POST["lastname"],$_POST["email"]);
}else{
    $contact = new Contact($_GET["id"],$_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["phone"]);
}

$contact->modify($connect);

header("Location:../view/home.php");