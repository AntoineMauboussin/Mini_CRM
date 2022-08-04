<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - mini-crm</title>
</head>
<body>
    <h1>Contacts</h1>
    <a href='./add.php'>Add new</a>
    <br/>
    <br/>
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>E-mail</th>
            <th>Phone number</th>
        </tr>
        <?php
        require_once '../model/connect.php';
        require_once '../model/contact.php';

        $contacts = Contact::getAll();

        foreach($contacts as $contact){
            $html = "<tr>".
            "<td>".$contact->firstname."</td>".
            "<td>".$contact->lastname."</td>".
            "<td>".$contact->email."</td>";
            if(isset($contact->phone)){
                $html .= "<td>".$contact->phone."</td>";
            }
            $html .= "<td><a href='./modify.php?id=".$contact->id."'>Modify</a></td>".
            "<td><a href='../controller/deleteContact.php?id=".$contact->id."'>Delete</a></td>".
            "</tr>";

            echo($html);
        }
        ?>
    </table>
</body>
</html>