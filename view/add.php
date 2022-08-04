<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add - mini-crm</title>
</head>
<body>
    <?php
    require_once '../model/connect.php';
    require_once '../model/contact.php';

    ?>
    <h1>Create contact</h1>
    <?php
    //affichage d'un message en cas de champs non valides
    if(isset($_GET["message"]) && $_GET["message"] == "unvalidated"){
        echo("<p>One or several field is not valid</p>");
    }
    ?>
    <form method="POST" action="../controller/addContact.php">
        <label for="firstname">First name : </label>
        <input type="text" name="firstname" required>
        <br />
        <label for="lastname">Last name : </label>
        <input type="text" name="lastname" required>
        <br />
        <label for="email">E-mail : </label>
        <input type="email" name="email" required>
        <br />
        <label for="phone">Phone number : </label>
        <input type="tel" name="phone">
        <br />
        <input type=submit value="Create">
    </form>
</body>
</html>