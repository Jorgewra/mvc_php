<?php
require_once ('../models/employee.php');
class EmployeeController
{
    private $conn;
    function __construct($conn){
        $this->conn = $conn;
    }
    function getEmployees (){
        $result = mysqli_query($this->conn, 'SELECT emp.* FROM employees emp ORDER BY emp.role asc');
        $list = [];
        if (!$result) {
            die('Invalid query: ' . mysqli_error());
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $employee = new Employee(
                $row['id'],
                $row['name'],
                $row['phone'],
                $row['company'],
                $row['email'],
                $row['sector'],
                $row['role'],
                $row['created'],
                $row['updated']
            );
            
            array_push($list, $employee);
        }
        return $list;
    }
    /**
     * $id = Identify Object
     */
    function deleteEmployees ($id){
        $sql = "DELETE FROM employees WHERE id =".$id;
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            return $result;
        }
        return $sql;
    }
    /**
     * $id = Identify Object
     */
    function findEmployees ($id){
        $sql = "SELECT * FROM employees WHERE id =".$id;
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            return "Error";
        }
        $row = mysqli_fetch_assoc($result);
        $employee = new Employee(
            $row['id'],
            $row['name'],
            $row['phone'],
            $row['company'],
            $row['email'],
            $row['sector'],
            $row['role'],
            $row['created'],
            $row['updated']
        );
        return $employee;
    }
    /**
     * $text = text for search
     * $fieldName = Name field for search
     */
    function searchEmployees ($text, $fieldName){
        $sql = "SELECT * FROM employees WHERE ".$fieldName." like '%".$text."%' ORDER BY role asc";
        $result = mysqli_query($this->conn, $sql);
        $list = [];
        if (!$result) {
            die('Invalid query: ' . mysqli_error());
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $employee = new Employee(
                $row['id'],
                $row['name'],
                $row['phone'],
                $row['company'],
                $row['email'],
                $row['sector'],
                $row['role'],
                $row['created'],
                $row['updated']
            );
                
            array_push($list, $employee);
        }
        
        return $list;
    }
    /**
     * $employee = Object
     */
    function saveEmployees ($employee){
        $sql = $this->prepareField($employee, $employee->id !=0 ? 2 : 1);
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            return $sql;
        }
        return $sql;
    }
    /**
     * $employee = Object
     * $type = (1)- Insert or (2) update 
     */
    private function prepareField($employee, $type){
            if($type == 1){
                return "INSERT INTO employees SET ".
                    "name='".$employee->name."', ".
                    "phone='".$employee->phone."', ".
                    "company='".$employee->company."', ".
                    "email='".$employee->email."', ".
                    "sector='".$employee->sector."', ". 
                    "role='".$employee->role."', ".
                    "created='". date("Y-m-d H:i:s")."', ".
                    "updated='".date("Y-m-d H:i:s")."' ";
            }else{
                return "UPDATE  employees SET ".
                    "name='".$employee->name."', ".
                    "phone='".$employee->phone."', ".
                    "company='".$employee->company."', ".
                    "email='".$employee->email."', ".
                    "sector='".$employee->sector."', ". 
                    "role='".$employee->role."', ".
                    "updated='".date("Y-m-d H:i:s")."' ".
                    "WHERE id =".$employee->id;
            }
            
    }
}
?>