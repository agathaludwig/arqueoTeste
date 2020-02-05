<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title> Editar Projeto </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
$id = $_GET['id'];
?>
<body>
<div class="container" style="margin: 40px auto; width: 500px">
    <h4> Editar Projeto </h4>
    <form action="_atualizarProjeto.php" method="post" style="margin-top: 20px">
      <?php
      $sql1 = "SELECT * FROM `projetos` WHERE idProjeto = $id ";
      $buscar1 = mysqli_query($conexao, $sql1);
      while ($array = mysqli_fetch_array($buscar1)) {
        //$idusuario = $array['idusuario'];
        $acronimo = $array['acronimo'];
        $nome = $array['nome'];
        $coordenador = $array['coordenador'];
        $status = $array['status'];
      ?>
        <div class="form-group">
          <label> Acrônimo </label>
          <input type="text" class="form-control" name="acronimo" value="<?php echo $acronimo ?>">
          <input type="number" class="form-control" name="id" value="<?php echo $id ?>" style="display: none">
        </div>
        <div class="form-group">
          <label> Nome </label>
          <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>">
        </div>
        
        <div class="form-group">
        <label> Coordenador </label>
        <select class="custom-select" name="coordenador">
          
          <?php
          $sql2 = "SELECT * FROM usuarios WHERE nivelUsuario = 1 OR nivelUsuario = 2";
          $buscar2 = $conexao->query($sql2);
          while ($row1 = $buscar2->fetch_array()) {
            echo "<option value= '$row1[0]'";
            if ($row1[0] == $coordenador) {
              echo "selected";
            }
            echo "> $row1[1] </option>";
          }
          ?>
        </select>
      </div>
        

      
      <div class="form-group">
        <label> Pesquisadores envolvidos</label><br>
        <?php
        $sql3 = "SELECT idUsuario FROM usuario_projeto WHERE idProjeto = $id";
        $buscar3 = $conexao->query($sql3);
        $idpesquisadoresnoprojeto = $buscar3->fetch_all();

        $sql4 = "SELECT idUsuario, nomeUsuario FROM usuarios";
        $buscar4 = $conexao->query($sql4);
        $i=0;

        while ($row2 = $buscar4->fetch_array()) { 
          $i++; ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox<?php echo $i ?>" name='pesquisadores[]' value="<?php echo $row2[0] ?>" 
            <?php foreach ($idpesquisadoresnoprojeto as $key => $idpesq) {
              if ($idpesq[0] == $row2[0]) {
                echo "checked";
              }
            }?>>
            <label class="form-check-label" for="inlineCheckbox<?php echo $i ?>"><?php echo $row2[1] ?></label>
          </div>
        <?php } ?>
      </div>

      <div class="form-group">
        <label> Status</label> <br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" 
          <?php if ($status == 1) {echo " checked"; }?> >
          <label class="form-check-label" for="inlineRadio1">Em andamento</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2"
          <?php if ($status == 2) { echo " checked";}?> >
          <label class="form-check-label" for="inlineRadio2">Encerrado</label>
        </div>
      </div>


      <?php } ?>
      <div style="text-align: right">
       <a href="listarProjetos.php" role="button" class="btn btn-sm btn-primary">Voltar</a> 
       <button type="submit" class="btn btn-sm btn-danger" >Atualizar</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>