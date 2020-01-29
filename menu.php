<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title> Menu principal </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style type="text/css">
  #sombra {
    -webkit-box-shadow: 10px 10px 31px -5px rgba(163,163,163,1);
    box-shadow: 10px 10px 31px -5px rgba(163,163,163,1);
  }
</style>
</head>

<body>
  <?php

  session_start();
  $usuario = $_SESSION['usuario'];

  if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
  }

  $nomeDaInclude1 = "criaClasseBanco.inc.php";
  require_once $nomeDaInclude1;

  $banco = new Banco();
  $conexao = $banco->conectar();
  $banco->definirCharset($conexao);
  $banco->criarBanco($conexao);
  $banco->usaBanco($conexao);
  $banco->criaTabela($conexao);

  $sql = "SELECT nivelUsuario FROM $banco->tabelaUsuarios WHERE loginUsuario = '$usuario' ";
  $buscar = $conexao->query($sql) or die($conexao->error);

  $array = mysqli_fetch_array($buscar);
  $nivel = $array['nivelUsuario'];
  ?>

  <div class="container" style="margin-top: 40px">
    <div class="card-deck">
      <?php
      if (($nivel == 1) || ($nivel == 2)) {
      ?>
        <div class="card text-center" id="sombra">
          <img src="img/equipe.jpg" class="card-img-top" alt="equipe: silhuetas de pessoas">
          <div class="card-body">
            <h5 class="card-title">Gerenciar equipe</h5>
            <p class="card-text">Adicionar, remover ou editar usuários.</p>
          </div>
          <div class="card-footer" style="border: none; background-color: white">
            <a href="listarUsuarios" class="btn btn-primary">Listar usuários</a>
          </div>
        </div>

        <div class="card text-center" id="sombra">
          <img src="img/projetos.jpg" class="card-img-top" alt="projetos: pastas de arquivos">
          <div class="card-body">
            <h5 class="card-title">Gerenciar projetos</h5>
            <p class="card-text">Adicionar, remover ou editar projetos.</p>
          </div>
          <div class="card-footer" style="border: none; background-color: white">
            <a href="listarProjetos" class="btn btn-primary">Listar projetos</a>
          </div>
        </div>

        <div class="card text-center" id="sombra">
          <img src="img/colecao.jpg" class="card-img-top" alt="coleções arqueológicas: prateleiras com materiais cerâmicos">
          <div class="card-body">
            <h5 class="card-title">Gerenciar coleções arqueológicas</h5>
            <p class="card-text">Adicionar, remover ou editar coleções arqueológicas.</p>
          </div>
          <div class="card-footer" style="border: none; background-color: white">
            <a href="listarColecoes" class="btn btn-primary" style>Listar coleções</a>
          </div>
        </div>
    </div>
  </div>

  <div class="container" style="margin-top: 40px">
    <div class="card-deck">
      <div class="card text-center" id="sombra">
        <img src="img/cronograma.jpg" class="card-img-top" alt="cronograma: agenda">
        <div class="card-body">
          <h5 class="card-title">Definir cronograma</h5>
          <p class="card-text">Estabelecer, alterar, remover e monitorar cronogramas.</p>
        </div>
        <div class="card-footer" style="border: none; background-color: white">
          <a href="listarCronogramas" class="btn btn-primary" style>Cronogramas</a>
        </div>
      </div>

      <div class="card text-center" id="sombra">
        <img src="img/produtividade.jpg" class="card-img-top" alt="produtividade: gráficos">
        <div class="card-body">
          <h5 class="card-title">Monitore a produtividade</h5>
          <p class="card-text">Checar a produtividade individual.</p>
        </div>
        <div class="card-footer" style="border: none; background-color: white">
          <a href="listarProdutividade" class="btn btn-primary" style>Produtividade</a>
        </div>
      </div>

      <div class="card text-center" id="sombra">
        <img src="img/relatorio.jpg" class="card-img-top" alt="relatorio: pessoa olhando papel">
        <div class="card-body">
          <h5 class="card-title">Gerar relatórios</h5>
          <p class="card-text">Selecionar e gerar relatórios de dados de análises.</p>
        </div>
        <div class="card-footer" style="border: none; background-color: white">
          <a href="gerarRelatorios" class="btn btn-primary" style>Relatórios</a>
        </div>
      </div>

    </div>
  </div>

<?php } ?>

<div class="container" style="margin-top: 40px; margin-bottom: 40px">
    <div class="card-deck">
      <div class="card text-center" id="sombra">
        <img src="img/ceramica.jpg" class="card-img-top" alt="ceramica: mesa de análise com materiais aqueológicos">
        <div class="card-body">
          <h5 class="card-title">Análise cerâmica</h5>
          <p class="card-text">Selecionar projeto e coleção para iniciar uma análise.</p>
        </div>
        <div class="card-footer" style="border: none; background-color: white">
          <a href="listarParaAnalise" class="btn btn-primary" style>Análise</a>
        </div>
      </div>
    </div>
  </div>
  <form action="logout.php" method="post">
  <button type="submit" name="sair" class="btn btn-secondary">Sair</button>
  </form>
    

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>