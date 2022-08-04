<?php 

class Contact
{
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    
    //création d'un contact avec ou sans numéro
    public function __construct()
    {
        $nbParam=func_num_args();
        $args=func_get_args();
        if($nbParam == 4)
        {
            $this->id = $args[0];
            $this->firstname = $args[1];
            $this->lastname = $args[2];
            $this->email = $args[3];
        }
        else if($nbParam == 5)
        {
            $this->id = $args[0];
            $this->firstname = $args[1];
            $this->lastname = $args[2];
            $this->email = $args[3];
            $this->phone = $args[4];
        }
    }
    
    //insert le contact dans la base de données
    public function insert(): void
    {
        if(!isset($this->phone)){
            $insert = "Insert into Contact (firstname, lastname, email) values ('".$this->firstname."','".$this->lastname."', '".$this->email."')";
            $this->id = mysqli_query($GLOBALS["connect"], $insert);
        }
        else
        {
            $insert = "Insert into Contact (firstname, lastname, email, phone) values ('".$this->firstname."','".$this->lastname."', '".$this->email."', '".$this->phone."')";
            $this->id = mysqli_query($GLOBALS["connect"], $insert);
        }

        $this->id = $GLOBALS["connect"]->insert_id;
    }

    //modifie le contact dans la bdd selon l'id
    public function modify(): void
    {
        if($this->id == null){
            return;
        }
        if(!isset($this->phone)){
            $update = "Update Contact set firstname = '".$this->firstname."', lastname = '".$this->lastname."', email = '".$this->email."' where id = '".$this->id."'";
            mysqli_query($GLOBALS["connect"], $update);
        }
        else
        {
            $update = "Update Contact set firstname = '".$this->firstname."', lastname = '".$this->lastname."', email = '".$this->email."', phone = '".$this->phone."' where id = ".$this->id."";
            mysqli_query($GLOBALS["connect"], $update);
        }
    }

    //supprime le contact dans la bdd selon l'id
    public function delete(): void
    {
        if($this->id == null){
            return;
        }
        $update = "Delete from Contact where id = ".$this->id."";
        mysqli_query($GLOBALS["connect"], $update);
    }

    //vérifie la validité du contact
    public function verifValidity(): bool
    {
        if(!empty($this->firstname) && !empty($this->lastname) && !empty($this->email) && filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            if(!empty($this->phone)){
                if(is_numeric($this->phone)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    //récupère un contact dans la bdd selon son id
    public static function getFromId(int $id)
    {
        $update = "Select * from Contact where id = ".$id."";
        $result = mysqli_query($GLOBALS["connect"], $update);

        while($row = $result->fetch_assoc())
        {
            if(!isset($row["phone"])){
                return new self($id, $row["firstname"],$row["lastname"],$row["email"]);
            }else{
                return new self($id, $row["firstname"],$row["lastname"],$row["email"],$row["phone"]);
            }
        }
        return null;
    }

    //récupère le tableau de tous les contacts a partir de la bdd
    public static function getAll(): array
    {
        $update = "Select * from Contact";
        $result = mysqli_query($GLOBALS["connect"], $update);
        $contacts = [];

        while($row = $result->fetch_assoc())
        {
            if(!isset($row["phone"])){
                $contact = new self($row["id"], $row["firstname"],$row["lastname"],$row["email"]);
            }else{
                $contact = new self($row["id"], $row["firstname"],$row["lastname"],$row["email"],$row["phone"]);
            }
            array_push($contacts, $contact);
        }

        return $contacts;
    }
}

?>