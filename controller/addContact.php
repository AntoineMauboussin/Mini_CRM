<?php
require_once '../model/connect.php';
require_once '../model/contact.php';

if(!isset($_POST["phone"])){
    $contact = new Contact(null,$_POST["firstname"],$_POST["lastname"],$_POST["email"]);
}else{
    $contact = new Contact(null,$_POST["firstname"],$_POST["lastname"],$_POST["email"],$_POST["phone"]);
}

//ajoute le nouveau contacte a la bdd si valide, sinon retour au formulaire avec message d'erreur
if($contact->verifValidity()){
    $contact->insert();
    header("Location:../view/home.php");
}else{
    header("Location:../view/add.php?message=unvalidated&id=".$_GET["id"]);
}

