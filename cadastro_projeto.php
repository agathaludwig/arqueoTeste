<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Cadastro de Projeto </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
?>

<body>
<div class="container" style="margin: 40px auto; width: 500px">
    <h4>Cadastro de projeto </h4>
    <form action="_insert_projeto.php" method="post" style="margin-top: 20px">
      <div class="form-group">
        <label> Acrônimo </label>
        <input type="text" name="acronimo" class="form-control" autocomplete="off" required placeholder="Acrônimo">
      </div>

      <div class="form-group">
        <label> Nome </label>
        <input type="text" name="nome" class="form-control" autocomplete="off" required placeholder="Nome do Projeto">
      </div>

      <div class="form-group">
        <label> Coordenador </label>
        <select class="custom-select" name="coordenador">
          <option> Selecione um coordenador </option>
          <?php
          $query = "SELECT * FROM usuarios WHERE nivelUsuario = 1 OR nivelUsuario = 2";
          $buscar = $conexao->query($query);
          while ($row = $buscar->fetch_array()) {
            echo "<option value= '$row[0]'> $row[1] </option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label> Pesquisadores envolvidos</label><br>
        <?php
        $query = "SELECT * FROM usuarios";
        $buscar = $conexao->query($query);
        $i=0;
        while ($row = $buscar->fetch_array()) { 
          $i++; ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox<?php echo $i ?>" name='pesquisadores[]' value="<?php echo $row[0] ?>">
            <label class="form-check-label" for="inlineCheckbox<?php echo $i ?>"><?php echo $row[1] ?></label>
          </div>
        <?php } ?>
      </div>

      <div class="form-group">
        <label> Status</label> <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
          <label class="form-check-label" for="inlineRadio1">Em andamento</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2">
          <label class="form-check-label" for="inlineRadio2">Encerrado</label>
        </div>
      </div>

      <div style="text-align: right">
        <a href="listarProjetos.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
        <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
      </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>