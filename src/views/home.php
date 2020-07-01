<?php
require_once (ROOT_PATH ."/src/controllers/employeeController.php");
$api = new EmployeeController($conn);
$list = $api->getEmployees();

if(isset($_GET["id"])){
  $api->deleteEmployees($_GET["id"]);
  $list = $api->getEmployees();
}
?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>FontEnd - MVC</title>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<body>
    <div class="header-page">
      DigiBoard
    </div>
    <div class="container">
    <table>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Telefone</th>
      <th>e-mail</th>
      <th>Empresa</th>
      <th>Setor</th>
      <th>Cargo</th>
      <th></th>
      <th></th>
    </tr>
    <?php 
    foreach($list as $o){
      echo "<tr>";
      echo "  <td>$o->id</td>";
      echo "  <td>$o->name</td>";
      echo "  <td>$o->phone</td>";
      echo "  <td>$o->email</td>";
      echo "  <td>$o->company</td>";
      echo "  <td>$o->sector</td>";
      echo "  <td>$o->role</td>";
      echo "  <td><a href='/src/views/formEmployee.php?id=$o->id'>edit</a></td>";
      echo "  <td><a href='/?id=$o->id&type=DELETE'>delete</a></td>";
      echo "</tr>";
    }
    ?>
  </table>
    </div>
</body>
</html>