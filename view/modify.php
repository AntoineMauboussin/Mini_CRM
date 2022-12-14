<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify - mini-crm</title>
</head>
<body>
    <?php
    require_once '../model/connect.php';
    require_once '../model/contact.php';

    //récupération des infos du contact modifié
    $contact = Contact::getFromId($_GET["id"]);

    ?>
    <h1>Modify contact <?php echo($contact->firstname." ".$contact->lastname); ?></h1>
    <?php
    //affichage d'un message en cas de champs non valides
    if(isset($_GET["message"]) && $_GET["message"] == "unvalidated"){
        echo("<p>One or several field is not valid</p>");
    }
    ?>
    <!-- Formulaire de modification avec champs préremplis ave cles infos du contact -->
    <form method="POST" action="../controller/modifyContact.php?id=<?php echo($contact->id); ?>">
        <label for="firstname">First name : </label>
        <input type="text" name="firstname" value="<?php echo($contact->firstname); ?>" required>
        <br />
        <label for="lastname">Last name : </label>
        <input type="text" name="lastname" value="<?php echo($contact->lastname); ?>" required>
        <br />
        <label for="email">E-mail : </label>
        <input type="email" name="email" value="<?php echo($contact->email); ?>" required>
        <br />
        <label for="phone">Phone number : </label>
        <input type="tel" name="phone" value="<?php echo($contact->phone); ?>">
        <br />
        <input type=submit value="Modify">
    </form>
</body>
</html>