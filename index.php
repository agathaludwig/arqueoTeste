<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Acesso ao sistema</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style type="text/css">
  #tamanho {
    margin-top: 40px;
    width: 350px;
    border-radius: 15px;
    border: 2px solid #f3f3f3;
    -webkit-box-shadow: 10px 10px 31px -5px rgba(163,163,163,1);
    box-shadow: 10px 10px 31px -5px rgba(163,163,163,1);
    padding: 25px;
  }
</style>
</head>

<body>

<div class="container" id="tamanho">
<center>
  <img src="img/cadeado.png" width=125px hight=125px>
</center>

  <form action="index1.php" method="post" style="margin-top: 20px">
    <div class="form-group">
      <label> Usuário </label>
      <input type="text" class="form-control" name="usuario" placeholder="Usuário" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label> Senha </label>
      <input type="password" class="form-control" name="senha" placeholder="Senha" autocomplete="off" required>
    </div>

    <div style="text-align: right">
      <button type="submit" class="btn btn-sm btn-success">Acessar</button>
    </div>
  </form>
</div>
<center>
<div style="margin-top: 20px">
  <small>Se você não possui cadastro, fale com o coordenador ou gestor</a>.</small>
</div>
</center>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
  crossorigin="anonymous"></script>
</body>

</html>
