<?php
session_start();
if (!isset($_SESSION['usuario'])) {
	header('location: index.php');
	exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Cadastro de usuário </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <div class="container" style="margin-top: 40px; width: 400px">
  <h4>Cadastro de usuário </h4>
    <form action="_insert_usuario.php" method="post">
      <div class="form-group">
        <label> Nome </label>
        <input type="text" name="nomeusuario" class= "form-control" autocomplete="off" required placeholder="Nome completo">
      </div>
      <div class="form-group">
        <label> Email </label>
        <input type="email" name="emailusuario" class= "form-control" autocomplete="off" required placeholder="seu@email.com">
      </div>
      <div class="form-group">
        <label> Login </label>
        <input type="text" name="loginusuario" class= "form-control" autocomplete="off" required placeholder="Login">
      </div>
      <div class="form-group">
        <label> Senha </label>
        <input type="password" name="senhausuario" class= "form-control" autocomplete="off" required placeholder="Senha">
      </div>
      <div class="form-group">
        <label> Nível de Acesso</label>
        <select class="form-control" name="nivelusuario">
        <!-- <optgroup> agrupa as opções do option -->
          <option value="1">Gestor</option>
          <option value="2">Coordenador</option>
          <option value="3">Pesquisador</option>
        </select>
      </div>

      <div style="text-align: right">
      <a href="menu.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
      <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
    </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</body>

</html>