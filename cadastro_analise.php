<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Análise cerâmica </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style>
    div.jumbotron .form-group {
      margin: 0px;
    }

    div.jumbotron {
      padding: 10px 20px;
      margin: 0px 15px;
    }

    div.jumbotron p {
      font-size: 14px;
      margin: 0px;
    }

    div.jumbotron h5 {
      font-size: 15px;
    }

    div.jumbotron .form-row {
      height: 25px;
    }

    h5 {
      border-bottom: 1px solid #d8d8d8;
    }

    .rotulo {
      font-size: 16px;
      margin-bottom: 0px;
      margin-top: 10px;
    }

    label {
      font-size: 16px;
    }

    .form-check-label {
      font-size: 15px;
    }

    .hidden {
      display: none;
    }
  </style>
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;

$nomeDaInclude3 = "criaTabelasAnalise.inc.php";
require_once $nomeDaInclude3;

$idPeca = $_GET['idPeca'];

$sql1 = "SELECT * FROM `pecas` WHERE idPeca = $idPeca ";
$buscar1 = mysqli_query($conexao, $sql1);
$array = mysqli_fetch_array($buscar1);
$idColecao = $array['idColecao'];
$numCatalogo = $array['numCatalogo'];
$localizacao = $array['localizacao'];
$profundidade = $array['profundidade'];
$decoracao = $array['decoracao'];
$parte = $array['parte'];
$idAnalise = $array['idAnalise'];

$sql2 = "SELECT nome, idProjeto FROM `colecoes` WHERE idColecao = $idColecao ";
$buscar2 = mysqli_query($conexao, $sql2);
$array = mysqli_fetch_array($buscar2);
$nomeColecao = $array['nome'];
$idProjeto = $array['idProjeto'];

$sql3 = "SELECT nome FROM `projetos` WHERE idProjeto = $idProjeto";
$buscar3 = mysqli_query($conexao, $sql3);
$array = mysqli_fetch_array($buscar3);
$nomeProjeto = $array['nome'];

?>

<body>
  <div class="container-fluid" style="padding: 50px;">
    <h4 style="margin-bottom: 15px;">Análise de cerâmica </h4>

    <form action="_insert_analise.php" method="post" style="margin-top: 20px">
      <h5>Identificação</h5>
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-2">
            <label class="rotulo"> Número de catálogo </label>
            <input type="number" class="form-control" name="numCatalogo" value="<?php echo $numCatalogo ?>" required>
          </div>

          <div class="col-md-10">
            <div class="jumbotron">
              <h5>Procedência</h5>
              <div class="form-group row">
                <div class="col-md-6">
                  <p> Projeto: <strong><?php echo $nomeProjeto ?></strong></p>
                  <input type="number" class="form-control" name="idProjeto" value="<?php echo $idProjeto ?>" style="display: none">
                </div>

                <div class="col-md-6">
                  <p> Coleção: <strong><?php echo $nomeColecao ?></strong></p>
                  <input type="number" class="form-control" name="idColecao" value="<?php echo $idColecao ?>" style="display: none">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-3">
                  <p> Localização: <strong><?php echo $localizacao ?></strong></p>
                </div>
                <div class="col-md-3">
                  <p> Profundidade: <strong><?php echo $profundidade ?></strong> </p>
                </div>
                <div class="col-md-3">
                  <p> Decoração: <strong><?php echo $decoracao ?></strong> </p>
                </div>
                <div class="col-md-3">
                  <p> Porção: <strong><?php echo $parte ?></strong> </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <p class="rotulo">Tipo de artefato</p>
        <div class="form-row">
          <?php
          $query = "SELECT * FROM tipoDeArtefato ORDER BY ordem";
          $executa = $conexao->query($query);
          while ($row = $executa->fetch_array()) {
          ?>
            <div class='col-md-2'>
              <input type='radio' name='tipoDeArtefato' value='<?php echo $row[0]; ?>' id='<?php echo "tipo $row[0]"; ?>' onclick="mostrarCategoria(<?php echo $row[0]; ?>); ocultarManufatura(<?php echo $row[0]; ?>)">
              <label class="form-check-label" for='<?php echo "tipo $row[0]"; ?>'><?php echo $row[1]; ?> </label>
            </div>
          <?php }
          ?>
        </div>
      </div>
      <!-- CATEGORIA -->
      <div class="form-group hidden" id="categoria">
        <h5>Vasilha</h5>
        <p class="rotulo">Categoria do Fragmento </p>
        <div class="form-row">
          <?php
          $query = "SELECT * FROM categoria ORDER BY ordem";
          $executa = $conexao->query($query);
          while ($row = $executa->fetch_array()) {
          ?>
            <div class='col-md-3'>
              <input type='checkbox' name='categoria[]' value='<?php echo $row[0]; ?>' id='<?php echo "cat $row[0]"; ?>' onclick="mostrarMetricoBorda()">
              <label class="form-check-label" for='<?php echo "cat $row[0]"; ?>'><?php echo $row[1]; ?> </label>
            </div>
          <?php }
          ?>
        </div>
      </div>

      <div class="form-group">
        <h5>Dados métricos</h5>
        <div class="form-row">
          <div class="col-md-4">
            <label class="rotulo"> Espessura mínima </label>
            <input type="number" class="form-control" name="espMin" placeholder="mínima" required>
          </div>
          <div class="col-md-4">
            <label class="rotulo"> Espessura máxima </label>
            <input type="number" class="form-control" name="espMax" placeholder="máxima" required>
          </div>
          <div class="col-md-4">
            <label class="rotulo"> Peso </label>
            <input type="number" class="form-control" name="espMax" placeholder="gramas" required>
          </div>
        </div>
        <!-- diametro, inclinacao e espessura da borda -->
        <div class="hidden" id="metricoBorda">
          <div class="form-row">
            <div class=" col-md-4">
              <label class="rotulo"> Espessura da borda </label>
              <input type="number" class="form-control" name="espBorda" placeholder="borda" required>
            </div>
            <div class="col-md-4">
              <label class="rotulo"> Diâmetro </label>
              <input type="number" class="form-control" name="diametro" placeholder="centímetros" required>
            </div>
            <div class="col-md-4">
              <label class="rotulo"> Inclinação </label>
              <select class="custom-select" name="inclinacao" required>
                <option>Selecione... </option>
                <?php
                $query = "SELECT * FROM inclinacao ORDER BY ordem";
                $executa = $conexao->query($query);
                while ($row = $executa->fetch_array()) {
                  echo "<option value= '$row[0]'> $row[1] </option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>

      <h5>Dados técnicos</h5>

      <div id="tecnicaManufatura">
        <p class="rotulo">Técnica de manufatura </p>
        <div class="form-row">
          <?php
          $query = "SELECT * FROM manufatura ORDER BY ordem";
          $executa = $conexao->query($query);
          while ($row = $executa->fetch_array()) {
          ?>
            <div class='col-md-3'>
              <input type='checkbox' name='manufatura[]' value='<?php echo $row[0]; ?>' id='<?php echo "man $row[0]"; ?>'>
              <label class="form-check-label" for='<?php echo "man $row[0]"; ?>'><?php echo $row[1]; ?> </label>
            </div>
          <?php }
          ?>
        </div>
      </div>

      <div id="tempero">
        <p class="rotulo">Antiplásticos </p>
        <div class="form-row">
          <?php
          $query = "SELECT * FROM tempero ORDER BY ordem";
          $executa = $conexao->query($query);
          while ($row = $executa->fetch_array()) {
          ?>
            <div class='col-md-4'>
              <input type='checkbox' name='tempero[]' value='<?php echo $row[0]; ?>' id='<?php echo "temp $row[0]"; ?>'>
              <label class="form-check-label" for='<?php echo "temp $row[0]"; ?>'><?php echo $row[1]; ?> </label>
            </div>
          <?php }
          ?>
        </div>
      </div>

      <div id="porcTempero">
        <p class="rotulo">Porcentagem de tempero </p>
        <div class="form-row">
          <?php
          $query = "SELECT * FROM porcentagemTemp ORDER BY ordem";
          $executa = $conexao->query($query);
          while ($row = $executa->fetch_array()) {
          ?>
            <div class='col-md-3'>
              <input type='radio' name='porcentagemTemp' value='<?php echo $row[0]; ?>' id='<?php echo "port $row[0]"; ?>'>
              <label class="form-check-label" for='<?php echo "port $row[0]"; ?>'><?php echo $row[1]; ?> </label>
            </div>
          <?php }
          ?>
        </div>
      </div>

    </form>

    <div style="text-align: right">
      <a href="listarPecas?id=<?php echo $idColecao ?>.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
      <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
    </div>
  </div>

  <script>
    function ocultarManufatura(id) {
      if (id == 2) {
        document.getElementById("tecnicaManufatura").style.display = 'none';
      }
    }

    function mostrarCategoria(id) {
      if (id == 1) {
        document.getElementById("categoria").style.display = 'block';
      } else {
        document.getElementById("categoria").style.display = 'none';
      }
    }

    function mostrarMetricoBorda() {
      // os valores da [] são as posições no array
      var categoria = document.getElementsByName("categoria[]")
      if (categoria[1].checked == true || categoria[16].checked == true || categoria[18].checked == true) {
        document.getElementById("metricoBorda").style.display = 'block';
      } else {
        document.getElementById("metricoBorda").style.display = 'none';
      }
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>