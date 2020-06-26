<?php
include_once('../config/connections.php');
require_once('../models/employee.php');
class EmployeeController
{
    function getEmployees (){
        $result = mysql_query('SELECT emp.* FROM employees emp ORDER BY emp.name asc');
        $list = [];
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        while ($row = mysql_fetch_assoc($result)) {
            $employee = new Employee(
                $row['id'],
                $row['nome'],
                $row['phone'],
                $row['company'],
                $row['email'],
                $row['sector'],
                $row['role'],
                $row['created'],
                $row['updated']
            );
            
            array_push($list, );
        }
        return $list;
    }
}
?>