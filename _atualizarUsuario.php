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

  $id = trim($conexao->escape_string($_POST['id']));
  $nomeusuario = trim($conexao->escape_string($_POST['nomeusuario']));
  $emailusuario = trim($conexao->escape_string($_POST['emailusuario']));
  $loginusuario = trim($conexao->escape_string($_POST['loginusuario']));
  $nivelusuario = trim($conexao->escape_string($_POST['nivelusuario']));

  $sql = "UPDATE `usuarios` SET `nomeUsuario`='$nomeusuario', `emailUsuario`='$emailusuario', `loginUsuario`='$loginusuario', `nivelUsuario`=$nivelusuario  WHERE idUsuario = $id";

  $atualizar = $conexao->query($sql) or die($conexao->error);

  header("Location: listarUsuarios.php?editado"); 
?>
