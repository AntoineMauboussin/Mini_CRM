<?php 

class Contact
{
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    
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
    
    public function insert($connect): void
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

    public function modify($connect): void
    {
        if(!isset($this->phone)){
            $update = "Update Contact set firstname = '".$this->firstname."', lastname = '".$this->lastname."', email = '".$this->email."' where id = '".$this->id."'";
            mysqli_query($connect, $update);
        }
        else
        {
            $update = "Update Contact set firstname = '".$this->firstname."', lastname = '".$this->lastname."', email = '".$this->email."', phone = '".$this->phone."' where id = ".$this->id."";
            var_dump($update);
            mysqli_query($connect, $update);
        }
    }

    public function delete($connect): void
    {
        $update = "Delete from Contact where id = ".$this->id."";
        mysqli_query($connect, $update);
    }

    public static function getFromId(int $id, $connect): self
    {
        $update = "Select * from Contact where id = ".$id."";
        $result = mysqli_query($connect, $update);

        while($row = $result->fetch_assoc())
        {
            if(!isset($row["phone"])){
                return new self($id, $row["firstname"],$row["lastname"],$row["email"]);
            }else{
                return new self($id, $row["firstname"],$row["lastname"],$row["email"],$row["phone"]);
            }
        }
    }
}

?>