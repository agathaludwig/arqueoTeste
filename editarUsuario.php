<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title> Editar Usuário </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
$id = $_GET['id'];
?>
<body>
<div class="container" style="margin: 40px auto; width: 500px">
    <h4> Editar Usuário </h4>
    <form action="_atualizarUsuario.php" method="post" style="margin-top: 20px">
      <?php
      $sql = "SELECT * FROM `usuarios` WHERE idUsuario = $id ";
      $busca = mysqli_query($conexao, $sql);
      while ($array = mysqli_fetch_array($busca)) {
        //$idusuario = $array['idusuario'];
        $nomeusuario = $array['nomeUsuario'];
        $emailusuario = $array['emailUsuario'];
        $loginusuario = $array['loginUsuario'];
        $senhausuario = $array['senhaUsuario'];
        $nivelusuario = $array['nivelUsuario'];
      ?>
        <div class="form-group">
          <label> Nome </label>
          <input type="text" class="form-control" name="nomeusuario" value="<?php echo $nomeusuario ?>">
          <input type="number" class="form-control" name="id" value="<?php echo $id ?>" style="display: none">
        </div>
        <div class="form-group">
          <label> Email </label>
          <input type="text" class="form-control" name="emailusuario" value="<?php echo $emailusuario ?>">
        </div>
        <div class="form-group">
          <label> Login </label>
          <input type="text" class="form-control" name="loginusuario" value="<?php echo $loginusuario ?>">
        </div>
        <div class="form-group">
        <label> Nível de Acesso</label>
        <select class="form-control" name="nivelusuario">
        <!-- <optgroup> agrupa as opções do option -->
          <option value="1" <?php if(1 == $nivelusuario ){ echo "selected";}  ?> >Gestor</option>
          <option value="2" <?php if(2 == $nivelusuario ){ echo "selected";}  ?> >Coordenador</option>
          <option value="3" <?php if(3 == $nivelusuario ){ echo "selected";}  ?> >Pesquisador</option>
        </select>
      </div>

      <?php } ?>
      <div style="text-align: right">
       <a href="listarUsuarios.php" role="button" class="btn btn-sm btn-primary">Voltar</a> 
       <button type="submit" class="btn btn-sm btn-danger" >Atualizar</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>