<?php
require_once (ROOT_PATH ."/src/controllers/employeeController.php");
$api = new EmployeeController($conn);
$list = $api->getEmployees();
$list_aux = [];
$list_graf = [];
/**
 * Id para excluir dados
 */
if(isset($_GET["id"])){
  $api->deleteEmployees($_GET["id"]);
  $list = $api->getEmployees();
}
/** 
 * 
 */
if(isset($_GET["search"])){
  $list_it = $api->searchEmployees($_GET["search"],$_GET["keywords"]);
  if(is_array($list_it)){
    $list = $list_it ;
  }else{
    echo "<script>alert('Não encontrado!')</script>";
  }
}
/**
 * Organizar dados para o Gráfico
 */
if(is_array($list)){
  $count = 0;
  $nameRole = "";
  foreach($list as $ob){
    if($nameRole !== $ob->role){
      $count = 0;
      $nameRole = $ob->role;
      foreach($list as $comp){
        if($ob->role == $comp->role){
          $count++;
        }
      }
      $obj_graf = ["nome"=>$nameRole, "qtd"=>$count];
      array_push($list_graf, $obj_graf);
    }  
  }
}
?>
<html>

<head>
    <meta charset="UTF-8" />
    <title>FontEnd - MVC</title>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Cargo', 'Quantidade'], 
            <?php foreach($list_graf as $og) {
                echo "['".$og['nome'].
                "',".$og['qtd'].
                "],";
            } ?>
        ]);

        var options = {
            title: 'Cargos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    </script>
</head>

<body>
    <div class="header-page">
        DigiBoard
    </div>
    <div class="container">
        <a href='/src/views/formEmployee.php'>Novo Cadastro</a>
        <div>
            <form method="GET" action="?type=search">
                <select name="keywords">
                    <option value="name">Nome</option>
                    <option value="phone">Telefone,</option>
                    <option value="company">Empresa</option>
                    <option value="sector">Setor</option>
                    <option value="email">E-mail</option>
                    <option value="role">Cargo</option>
                </select>
                <input type='text'  name='search' value='' />
                <input type="submit" value="Pesquisar">
            </form>
        </div>
        <table>
            <tr>
                <td>
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
                </td>
                <td>
                    <div class="graf">
                        <div id="piechart" style="width: 350px; height: 250px;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>