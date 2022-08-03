<?php

require_once '../model/connect.php';

$select = "Select * from Contact";
$result = mysqli_query($connect, $select);

$contacts = [];

while($row = $result->fetch_assoc())
{
    array_push($contacts, $row);
}