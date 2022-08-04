<?php
require_once '../model/connect.php';
require_once '../model/contact.php';

$contact = Contact::getFromId($_GET["id"],$connect);

$contact->delete();

header("Location:../view/home.php");