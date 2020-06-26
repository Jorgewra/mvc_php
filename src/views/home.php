<php?

?>
<html>
<head>
<meta charset="UTF-8"/>
    <title>FontEnd - MVC</title>
</head>
<body>
    <div>
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

    <tr *ngFor="let emp of listEmployees">
      <td>{{emp.id}}</td>
      <td>{{emp.name}}</td>
      <td>{{emp.phone}}</td>
      <td>{{emp.email}}</td>
      <td>{{emp.company}}</td>
      <td>{{emp.sector}}</td>
      <td>{{emp.role}}</td>
      <td>
        <button>
          edit
        </button>
      </td>
      <td>
        <button>
          delete
        </button>
      </td>
    </tr>
  </table>
    </div>
</body>
</html>