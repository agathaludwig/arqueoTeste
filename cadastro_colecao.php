<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Cadastro de Coleção Arqueológica </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
$idProjeto = $_GET['id'];

$sql1 = "SELECT nome FROM `projetos` WHERE idProjeto = $idProjeto ";
$buscar1 = mysqli_query($conexao, $sql1);
while ($array = mysqli_fetch_array($buscar1)) {
  $nomeProjeto = $array['nome'];
} 
?>

<body>
<div class="container" style="margin: 40px auto; width: 500px">
  <?php 
if (isset($_GET['invalido'])){
  ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Formato de tabela de numeração inválido. <br> Tente cadastrar novamente.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
<?php } ?>
    <h4>Cadastro de coleção arqueológica </h4>
    <form action="_insert_colecao.php" method="post" enctype = "multipart/form-data" style="margin-top: 20px">
    <div class="form-group">
                <label> Selecione um projeto </label>
                <select class="custom-select" name="idProjeto">
                    <?php
                    $query = "SELECT * FROM projetos";
                    $buscar = $conexao->query($query);
                    while ($row = $buscar->fetch_array()) {
                      echo "<option value= '$row[0]'";
                      if ($row[0] == $idProjeto) {
                        echo "selected";
                      }
                      echo "> $row[2] </option>";
                    }
                    ?>
                </select>
            </div>

      <div class="form-group">
        <label> Nome da Coleção Arqueológica </label>
        <input type="text" class="form-control" name="nome" placeholder="Nome">
      </div>

      <div class="form-group">
        <label> Tipo de material</label> <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo" id="inlineRadio1" value="1">
          <label class="form-check-label" for="inlineRadio1">Cerâmica</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo" id="inlineRadio2" value="2">
          <label class="form-check-label" for="inlineRadio2">Lítico</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo" id="inlineRadio3" value="3">
          <label class="form-check-label" for="inlineRadio3">Louça</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo" id="inlineRadio4" value="4">
          <label class="form-check-label" for="inlineRadio4">Vidro</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo" id="inlineRadio5" value="5">
          <label class="form-check-label" for="inlineRadio5">Metal</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo" id="inlineRadio6" value="6">
          <label class="form-check-label" for="inlineRadio6">Ossos</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo" id="inlineRadio7" value="7">
          <label class="form-check-label" for="inlineRadio7">Fauna</label>
        </div>
      </div>

      <div class="form-group">
        <label> Total de peças numeradas </label>
        <input type="number" name="numPecas" class="form-control" required>
      </div>

      <div class="form-group">
        <label> Status</label> <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="status" id="status1" value="1">
          <label class="form-check-label" for="status1">Não iniciado</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="status" id="status2" value="2">
          <label class="form-check-label" for="status2">Em andamento</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="status" id="status3" value="3">
          <label class="form-check-label" for="status3">Concluído</label>
        </div>
      </div>

      <div class="form-group">
        <label for="inputFile1">Insira a planilha de numeração <strong>(.csv)<strong></label>
        <input type="file" class="form-control-file" id="inputFile1" name="tabelaNumeracao">
        <small> * A planilha não deve conter cabeçalho. </small><br>
        <small> * As colunas devem ser: 1) Número de catálogo, 2) Número de fragmentos, 3) Localização, 4) Profundidade, 5) Número de Coleta, 6) Decoração, 7) Parte da peça, 8) Observações. </small>
      </div>

      <div style="text-align: right">
        <a href="listarColecoes.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
        <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
      </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>