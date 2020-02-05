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

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Crushed&display=swap');
     #logo {
      font-family: 'Crushed', cursive;
      font-size: 40px;
      color: #999;
      padding: 0px;
     }
     #user {
      padding-right: 20px;
     }
  </style>
</head>
<!-- TODO fazer um rodapé -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<span class="navbar-brand" id="logo"> arqueoData </span>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(Página atual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Desativado</a>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <span class="navbar-text" id="user"> Bem vindo, <?php echo $usuario ?> </span>
    <a class="nav-link" href="logout.php">Sair</a>
    </form>
  </div>
</nav>