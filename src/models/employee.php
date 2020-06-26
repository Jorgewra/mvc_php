<?php
require_once 'person.php';

class Employee extends Person
{
    public $id;
    public $company;
    public $sector;
    public $role;
    public $created;
    public $updated;
    function __construct($id,$name,$phone,$company,$email,$sector,$role,$created,$updated){
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->company = $company;
        $this->company = $email;
        $this->sector = $sector;
        $this->role = $role;
        $this->created = $created;
        $this->updated = $updated;

    }
}
?>
