<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Editar Peça Arqueológica </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/bb54122f21.js" crossorigin="anonymous"></script>
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
$idPeca = $_GET['id'];

$sql1 = "SELECT * FROM `pecas` WHERE idPeca = $idPeca ";
$buscar1 = mysqli_query($conexao, $sql1);
while ($array = mysqli_fetch_array($buscar1)) {
  $idColecao = $array['idColecao'];
  $numCatalogo = $array['numCatalogo'];
  $numFragmentos = $array['numFragmentos'];
  $localizacao = $array['localizacao'];
  $profundidade = $array['profundidade'];
  $numColeta = $array['numColeta'];
  $decoracao = $array['decoracao'];
  $parte = $array['parte'];
  $idAnalise = $array['idAnalise'];
}

$sql2 = "SELECT nome, idProjeto FROM `colecoes` WHERE idColecao = $idColecao ";
$buscar2 = mysqli_query($conexao, $sql2);
$array = mysqli_fetch_array($buscar2);
$nomeColecao = $array['nome'];
$idProjeto = $array['idProjeto'];

$sql3 = "SELECT nome FROM `projetos` WHERE idProjeto = $idProjeto ";
$buscar3 = mysqli_query($conexao, $sql3);
$array = mysqli_fetch_array($buscar3);
$nomeProjeto = $array['nome'];
?>

<body>
  <div class="container" style="margin: 40px auto; width: 500px">
    <h4> Editar Peça Arqueológica </h4>
    <form action="_atualizarPeca.php" method="post" style="margin-top: 20px">
      <div class="form-group">
        <label> Nome do Projeto</label>
        <input type="text" class="form-control" name="nomeProjeto" value="<?php echo $nomeProjeto ?>" disabled>
      </div>

      <div class="form-group">
        <label> Nome da Coleção Arqueológica </label>
        <input type="text" class="form-control" name="nome Colecao" value="<?php echo $nomeColecao ?>" disabled>
        <input type="number" class="form-control" name="idColecao" value="<?php echo $idColecao ?>" style="display: none">

      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label> Nro de catálogo </label>
          <input type="number" class="form-control" name="numCatalogo" value="<?php echo $numCatalogo ?>" required>
          <input type="number" class="form-control" name="idPeca" value="<?php echo $idPeca ?>" style="display: none">
        </div>
        <div class="form-group col-md-4">
          <label> Nro de fragmentos </label>
          <input type="number" class="form-control" name="numFragmentos" value="<?php echo $numFragmentos ?>" required>
        </div>
        <div class="form-group col-md-4">
          <label> Nro de coleta </label>
          <input type="text" class="form-control" name="numColeta" value="<?php echo $numColeta ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label> Localização </label>
          <input type="text" class="form-control" name="localizacao" value="<?php echo $localizacao ?>" required>
        </div>
        <div class="form-group col-md-6">
          <label> Profundidade </label>
          <input type="text" class="form-control" name="profundidade" value="<?php echo $profundidade ?>" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label> Decoração </label>
          <input type="text" class="form-control" name="decoracao" value="<?php echo $decoracao ?>" required>
        </div>
        <div class="form-group col-md-6">
          <label> Parte da peça </label>
          <input type="text" class="form-control" name="parte" value="<?php echo $parte ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label>Observações</label>
        <textarea class="form-control" value="<?php echo $observacoes ?>"></textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-2">
          <label> Análise </label>
        </div>
        <div class="form-group col-md-2">
          <?php
          if ($idAnalise != null) {
          ?> <a style="color: #0d9e00" href="editar_analise.php?id=<?php echo $idAnalise ?>" target="_blank"><i class="fas fa-check"></i></a>
          <?php } else {
          ?> <a style="color: #f20000" href="cadastro_analise.php?idColecao=<?php echo $idColecao ?>&numCatalogo=<?php echo $numCatalogo ?>" target="_blank"><i class="fas fa-times"></i></a>
          <?php } ?>
        </div>
      </div>

      <div style="text-align: right">
        <a href="listarPecas.php?id=<?php echo $idColecao ?>" role="button" class="btn btn-sm btn-primary">Voltar</a>
        <button type="submit" class="btn btn-sm btn-danger">Atualizar</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>