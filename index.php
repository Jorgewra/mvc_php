<?php
require_once("./src/controllers/employeeController.php");

$product1 = new EmployeeController();
$list = $product1->getEmployees();
foreach($list as $o){
    print ($o['name']);
}

?>
