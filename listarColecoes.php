<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Lista de Coleções Arqueológicas </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/bb54122f21.js" crossorigin="anonymous"></script>
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
    Coleção arqueológica editada com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} else if (isset($_GET['removido'])){
  ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Coleção arqueológica removida com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} else if (isset($_GET['inserido'])){
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Coleção arqueológica adicionada com sucesso.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <?php
} 
?>
    <h3> Lista de Coleções Arqueológicas </h3>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Projeto</th>
          <th scope="col">Nome</th>
          <th scope="col">Tipo</th>
          <th scope="col">Total</th>
          <th scope="col">Status</th>
          <th scope="col">Tabela</th>
          <th scope="col">Ação</th>
        </tr>
      </thead>

      <?php

      $sql = "SELECT * FROM `colecoes`";
      $buscar = $conexao->query($sql) or die($conexao->error);

      while ($array = mysqli_fetch_array($buscar)) {
        $idProjeto = $array['idProjeto'];

        $sql2 = "SELECT acronimo FROM `projetos` WHERE idProjeto = $idProjeto";
        $buscar1 = $conexao->query($sql2) or die($conexao->error);
        $registro1 = $buscar1->fetch_array();
        $nomeProjeto = htmlentities($registro1[0], ENT_QUOTES, "UTF-8");

        $idColecao = $array['idColecao'];
        $nome = $array['nome'];
        $tipo = $array['tipo'];
        $numPecas = $array['numPecas'];
        $status = $array['status'];
        $tabelaNumeracao = $array['tabelaNumeracao'];
      ?>
        <tr>
          <td><?php echo $nomeProjeto ?></td>
          <td><?php echo $nome ?></td>
          <td><?php
              if ($tipo == 1) {
                echo "Cerâmica";
              }
              else if ($tipo == 2) {
                echo "Lítico";
              }
              else if ($tipo == 3) {
                echo "Louça";
              }
              else if ($tipo == 4) {
                echo "Vidro";
              }
              else if ($tipo == 5) {
                echo "Metal";
              }
              else if ($tipo == 6) {
                echo "Ossos";
              }
              else if ($tipo == 7) {
                echo "Fauna";
              }
              ?>
            </td>
          <td><?php echo $numPecas ?></td>
          <td><?php
              if ($status == 1) {
                echo "Não iniciado";
              }
              else if ($status == 2) {
                echo "Em andamento";
              }
              else if ($status == 3) {
                echo "Concluído";
              }
              ?>
            </td>
          <td><?php 
          if ($tabelaNumeracao != null) {
            echo "Enviada" ;
          } else {
            echo "Pendente";
          }?></td>
          <td><a class="btn btn-warning btn-sm" style="color:#fff" href="editarColecao.php?id=<?php echo $idColecao ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar</a>
            <a class="btn btn-danger btn-sm" style="color:#fff" href="_deletarColecao.php?id=<?php echo $idColecao ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Remover</a>
            <a class="btn btn-info btn-sm" style="color:#fff" href="cadastro_peca.php?id=<?php echo $idColecao ?>" role="button"><i class="far fa-plus-square"></i>&nbsp;Adicionar peça</a></td>
        <?php } ?>
        </tr>
    </table>

    <div style="text-align: right">
      <a href="cadastro_colecao.php" role="button" class="btn btn-sm btn-success">Cadastrar nova</a>
      <a href="menu.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>