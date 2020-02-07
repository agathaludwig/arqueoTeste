<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Lista de usuários </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/bb54122f21.js" crossorigin="anonymous"></script>
  <style>
    tr, td {
      text-align: center;
    }
  </style>
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
?>
<body>
<div class="container" style="margin: 40px auto">
  <?php 
if (isset($_GET['editado'])){
  ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Usuário editado com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} else if (isset($_GET['removido'])){
  ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Usuário removido com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} else if (isset($_GET['inserido'])){
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Usuário adicionado com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} 
?>
    <h3> Lista de usuários </h3>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Categoria</th>
          <th scope="col">Projetos</th>
          <th scope="col">Ação</th>
        </tr>
      </thead>

      <?php

      $sql1 = "SELECT * FROM `usuarios`";
      $buscar1 = $conexao->query($sql1) or die($conexao->error);


      while ($array = mysqli_fetch_array($buscar1)) {
        $idusuario = $array['idUsuario'];
        $nomeusuario = $array['nomeUsuario'];
        $nivelusuario = $array['nivelUsuario'];
      ?>
        <tr>
          <td><?php echo $nomeusuario ?></td>
          <td><?php
              if ($nivelusuario == 1) {
                echo "Gestor";
              }
              if ($nivelusuario == 2) {
                echo "Coordenador";
              }
              if ($nivelusuario == 3) {
                echo "Pesquisador";
              }
              ?></td>
          <!-- TODO Select com projetos -->
          <td><?php 
            $sql2 = "SELECT acronimo FROM projetos, usuario_projeto WHERE projetos.idProjeto = usuario_projeto.idProjeto AND usuario_projeto.idUsuario = $idusuario";
            $buscar2 = $conexao->query($sql2) or die($conexao->error);
            while ($row = mysqli_fetch_array($buscar2)) {
              $nomePesquisador = htmlentities($row[0], ENT_QUOTES, "UTF-8");
              echo "$nomePesquisador <br>";
            }?></td>
          <td><a class="btn btn-warning btn-sm" style="color:#fff" href="editarUsuario.php?id=<?php echo $idusuario ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar</a>
            <a class="btn btn-danger btn-sm" style="color:#fff" href="_deletarUsuario.php?id=<?php echo $idusuario ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Remover</a></td>
        <?php } ?>
        </tr>
    </table>

    <div style="text-align: right">
      <a href="cadastro_usuario.php" role="button" class="btn btn-sm btn-success">Cadastrar novo</a>
      <a href="menu.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>