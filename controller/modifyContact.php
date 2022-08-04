<?php
require_once '../model/connect.php';
require_once '../model/contact.php';

if(!isset($_POST["phone"])){
    $contact = new Contact($_GET["id"],$_POST["firstname"],$_POST["lastname"],$_POST["email"]);
}else{
    $contact = new Contact($_GET["id"],$_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["phone"]);
}


//modifie le contacte dans la bdd si valide, sinon retour au formulaire avec message d'erreur
if($contact->verifValidity()){
    $contact->modify();
    header("Location:../view/home.php");
}else{
    header("Location:../view/modify.php?message=unvalidated&id=".$_GET["id"]);
}