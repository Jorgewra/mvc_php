<?php
require_once ('../config/connections.php');
require_once ("../controllers/employeeController.php");
require_once ("../models/employee.php");

$api = new EmployeeController($conn);
$employee = new Employee(0,"","","","","","","","");
/**
 * Veirifca de tem id para alteração
 */
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
/**
 * Verifica de tem o tipo para atualizar os dados
 */
if(isset($_GET["type"])){
    if(isset($_POST["name"]) && 
       isset($_POST["phone"]) &&
       isset($_POST["email"]) &&
       isset($_POST["company"]) &&
       isset($_POST["sector"]) &&
       isset($_POST["role"])){
        $employee = new Employee(
            $_POST["id"],
            $_POST["name"],
            $_POST["phone"],
            $_POST["company"],
            $_POST["email"],
            $_POST["sector"],
            $_POST["role"],
            "",
            ""
          );
        if($employee->name == "" || 
            $employee->phone== "" || 
            $employee->email == "" || 
            $employee->company== "" || 
            $employee->sector== "" || 
            $employee->role == ""){
                echo "<script>alert('Informe todos os campos corretamente!')</script>";
        }else{
            $resp = $api->saveEmployees($employee);
            if($resp = 'OK'){
                echo "<script>alert('Registrado com sucesso!')</script>";
            }else{
                echo "<script>alert('houve uma falha!')</script>";
            }
        }
    }else{
        /**
         * Bucar a informação para não limpar os dados do form
         */
        if(isset($_POST["id"])) {
            $resp = $api->findEmployees($_POST["id"]);
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
        echo "<script>alert('Informe todos os campos corretamente!')</script>";
    }
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
            <form  method="POST" action="?type=register" autocomplete="off">
                <fieldset>
                    <legend>Registro de Funcionário</legend>
                    <?php 
                        echo "<input type='hidden'  name='id' value='$employee->id' ><br>";
                    ?>
                    <?php 
                        echo "<label>Nome:</label><input type='text'  name='name' value='$employee->name' ><br>";
                    ?>
                    <?php 
                        echo "<label>Telefone:</label><input type='text' name='phone' value='$employee->phone' ><br>";
                    ?>
                    <?php 
                        echo "<label>E-mail:</label><input type='text' name='email' value='$employee->email' ><br>";
                    ?>
                    <?php 
                        echo "<label>Empresa:</label><input type='text' name='company' value='$employee->company' ><br>";
                    ?>
                    <?php 
                        echo "<label>Setor:</label><input type='text' name='sector' value='$employee->sector' ><br>";
                    ?>
                    <?php 
                        echo "<label>Cargo:</label><input type='text' name='role' value='$employee->role' ><br>";
                    ?>

                    <input type="submit" value="Enviar">
                    <a href="/">Voltar</a>
                </fieldset>
            </form>
        </div>
    </div>

</body>

</html>