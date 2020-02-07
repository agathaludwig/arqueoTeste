<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Lista de Projetos </title>
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
    Projeto editado com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} else if (isset($_GET['removido'])){
  ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Projeto removido com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} else if (isset($_GET['inserido'])){
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Projeto adicionado com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} 
?>
    <h3> Lista de Projetos </h3>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Acrônimo</th>
          <th scope="col">Nome</th>
          <th scope="col">Coordenador</th>
          <th scope="col">Equipe</th>
          <th scope="col">Status</th>
          <th scope="col">Ação</th>
        </tr>
      </thead>

      <?php

      $sql1 = "SELECT * FROM `projetos` ORDER BY status";
      $buscar = $conexao->query($sql1) or die($conexao->error);

      while ($array = mysqli_fetch_array($buscar)) {
        $idProjeto = $array['idProjeto'];
        $acronimo = $array['acronimo'];
        $nome = $array['nome'];
        $idCoordenador = $array['coordenador'];

        $sql2 = "SELECT * FROM `usuarios` WHERE idUsuario = $idCoordenador";
        $buscar1 = $conexao->query($sql2) or die($conexao->error);
        $registro1 = $buscar1->fetch_array();
        $nomeCoordenador = htmlentities($registro1[1], ENT_QUOTES, "UTF-8");
    
        $status = $array['status'];
      ?>
        <tr>
          <td><?php echo $acronimo ?></td>
          <td><?php echo $nome ?></td>
          <td><?php echo $nomeCoordenador ?></td>
          <td><?php 
            $sql3 = "SELECT nomeUsuario FROM usuarios, usuario_projeto WHERE usuarios.idUsuario = usuario_projeto.idUsuario AND usuario_projeto.idProjeto = $idProjeto";
            $buscar2 = $conexao->query($sql3) or die($conexao->error);
            while ($row = mysqli_fetch_array($buscar2)) {
              $nomePesquisador = htmlentities($row[0], ENT_QUOTES, "UTF-8");
              echo "$nomePesquisador <br>";
            }
          
          ?></td>
          <td><?php
              if ($status == 1) {
                echo "Em andamento";
              }
              if ($status == 2) {
                echo "Encerrado";
              }
              ?>
            </td>
          <td><a class="btn btn-warning btn-sm" style="color:#fff" href="editarProjeto.php?id=<?php echo $idProjeto ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar</a>
            <a class="btn btn-danger btn-sm" style="color:#fff" href="_deletarProjeto.php?id=<?php echo $idProjeto ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Remover</a>
            <a class="btn btn-info btn-sm" style="color:#fff" href="cadastro_colecao.php?id=<?php echo $idProjeto ?>" role="button"><i class="far fa-plus-square"></i>&nbsp;Adicionar coleção</a></td>
        <?php } ?>
        </tr>
    </table>

    <div style="text-align: right">
      <a href="cadastro_projeto.php" role="button" class="btn btn-sm btn-success">Cadastrar novo</a>
      <a href="menu.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>