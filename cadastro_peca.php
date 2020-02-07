<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Cadastro individual de peça arqueológica </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
$idColecao = $_GET['id'];

$sql1 = "SELECT nome, idProjeto FROM `colecoes` WHERE idColecao = $idColecao ";
$buscar1 = mysqli_query($conexao, $sql1);
$array = mysqli_fetch_array($buscar1);
$nomeColecao = $array['nome'];
$idProjeto = $array['idProjeto'];

$sql2 = "SELECT nome FROM `projetos` WHERE idProjeto = $idProjeto ";
$buscar2 = mysqli_query($conexao, $sql2);
$array = mysqli_fetch_array($buscar2);
$nomeProjeto = $array['nome'];

$sql3 = "SELECT numCatalogo FROM `pecas` WHERE idColecao = $idColecao ORDER BY numCatalogo DESC LIMIT 1 ";
$buscar3 = mysqli_query($conexao, $sql3);
$array = mysqli_fetch_array($buscar3);
$ultimoCatalogo = $array['numCatalogo'];
$proximoNumCatalogo = $ultimoCatalogo+1;

?>

<body>
  <div class="container" style="margin: 40px auto; width: 500px">

    <h4>Cadastro individual de peça arqueológica </h4>
    <form action="_insert_peca.php" method="post" style="margin-top: 20px">

      <div class="form-group">
        <label> Nome do Projeto</label>
        <input type="text" class="form-control" name="nomeProjeto" value="<?php echo $nomeProjeto ?>" disabled>
        <input type="number" class="form-control" name="idProjeto" value="<?php echo $idProjeto ?>" style="display: none">
      </div>

      <div class="form-group">
        <label> Nome da Coleção Arqueológica </label>
        <input type="text" class="form-control" name="nome Colecao" value="<?php echo $nomeColecao ?>" disabled>
        <input type="number" class="form-control" name="idColecao" value="<?php echo $idColecao ?>" style="display: none">
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label> Nro de catálogo </label>
          <input type="number" class="form-control" name="numCatalogo" value="<?php echo $proximoNumCatalogo ?>" required>
        </div>
        <div class="form-group col-md-4">
          <label> Nro de fragmentos </label>
          <input type="number" class="form-control" name="numFragmentos" value="1" required>
        </div>
        <div class="form-group col-md-4">
          <label> Nro de coleta </label>
          <input type="text" class="form-control" name="numColeta">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label> Localização </label>
          <input type="text" class="form-control" name="localizacao" placeholder="ex. X123456/Y1234567" required>
        </div>
        <div class="form-group col-md-6">
          <label> Profundidade </label>
          <input type="text" class="form-control" name="profundidade" placeholder="ex. 0-10" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label> Decoração </label>
          <input type="text" class="form-control" name="decoracao" required>
        </div>
        <div class="form-group col-md-6">
          <label> Parte da peça </label>
          <input type="text" class="form-control" name="parte" required>
        </div>
      </div>

      <div class="form-group">
        <label>Observações</label>
        <textarea class="form-control" placeholder="Remontagens ou outras observações relevantes sobre o material"></textarea>
      </div>

      <div style="text-align: right">
        <a href="listarPecas?id=<?php echo $idColecao?>.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
        <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>