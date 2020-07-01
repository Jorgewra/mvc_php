<?php
define('ROOT_PATH',"/opt/lampp/htdocs");
require_once ('../config/connections.php');
require_once ("../controllers/employeeController.php");
require_once ("../models/employee.php");

$api = new EmployeeController($conn);
$employee = new Employee(0,"","","","","","","","");
if(isset($_GET["id"])){
    $resp = $api->findEmployees($_GET["id"]);
    $employee = new Employee(
      $resp->id,
      $resp->name,
      $resp->phone,
      $resp->company,
      $resp->email,
      $resp->sector,
      $resp->role,
      $resp->created,
      $resp->updated
    );
}
?>
<html>

<head>
    <meta charset="UTF-8" />
    <title>FontEnd - MVC</title>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>

<body>
    <div class="header-page">
        DigiBoard
    </div>
    <div class="container">
        <div id="area">
            <form id="formulario" autocomplete="off">
                <fieldset>
                    <legend>Registro de Funcionário</legend>
                    <?php 
                        echo "<label>Nome:</label><input type='text' value='$employee->name' ><br>";
                    ?>
                    <?php 
                        echo "<label>Telefone:</label><input type='text' value='$employee->phone' ><br>";
                    ?>
                    <?php 
                        echo "<label>E-mail:</label><input type='text' value='$employee->email' ><br>";
                    ?>
                    <?php 
                        echo "<label>Empresa:</label><input type='text' value='$employee->company' ><br>";
                    ?>
                    <?php 
                        echo "<label>Setor:</label><input type='text' value='$employee->sector' ><br>";
                    ?>
                    <?php 
                        echo "<label>Cargo:</label><input type='text' value='$employee->role' ><br>";
                    ?>
                    
                    <input class="btn_submit" type="submit" value="Enviar">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>