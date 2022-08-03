<?php 

require_once './connect.php';

class Contact
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    
    public function __construct()
    {
        $nbParam=func_num_args();
        $args=func_get_args();
        if($nbParam == 3)
        {
            $this->firstname = $args[0];
            $this->lastname = $args[1];
            $this->email = $args[2];
        }
        else if($nbParam == 4)
        {
            $this->firstname = $args[0];
            $this->lastname = $args[1];
            $this->email = $args[2];
            $this->phone = $args[3];
        }
    }
    
    public function insert()
    {
        if(!isset($this->phone)){
            $insert = "Insert into Contact (firstname, lastname, email) values ('".$this->firstname."','".$this->lastname."', '".$this->email."')";
            $this->id = mysqli_query($connect, $insert);
        }
        else
        {
            $insert = "Insert into Contact (firstname, lastname, email, phone) values ('".$this->firstname."','".$this->lastname."', '".$this->email."', '".$this->phone."')";
            $this->id = mysqli_query($connect, $insert);
        }
    }

    public function modify()
    {
        if(!isset($this->phone)){
            $update = "Update Contact set firstname = ".$this->firstname.", lastname = ".$this->lastname.", email = ".$this->email." where id = ".$this->id."";
            mysqli_query($connect, $update);
        }
        else
        {
            $update = "Update Contact set firstname = ".$this->firstname.", lastname = ".$this->lastname.", email = ".$this->email.", phone = ".$this->phone." where id = ".$this->id."";
            mysqli_query($connect, $update);
        }
    }

    public function delete()
    {
        $update = "Delete from Contact where id = ".$this->id."";
        mysqli_query($connect, $update);
    }
}

?>