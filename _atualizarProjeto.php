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
  $acronimo = trim($conexao->escape_string($_POST['acronimo']));
  $nome = trim($conexao->escape_string($_POST['nome']));
  $coordenador = trim($conexao->escape_string($_POST['coordenador']));
  $status = trim($conexao->escape_string($_POST['status']));

  // UPDATE TABELA PROJETOS
  $sql = "UPDATE `projetos` SET `acronimo`='$acronimo', `nome`='$nome', `coordenador`='$coordenador', `status`=$status  WHERE idProjeto = $id";
  $atualizar = $conexao->query($sql) or die($conexao->error);

  // UPDATE TABELA USUARIO_PROJETO
// FIXME há um jeito melhor?
  // REMOVER TODOS DESTE PROJETO
  $sql = "DELETE FROM $banco->relacaoUsuarioProjeto WHERE idProjeto = $id";
  $removerTodos = $conexao->query($sql) or die($conexao->error);
  // INSERT TABELA USUARIO_PROJETO
  $pesquisadores = $_POST["pesquisadores"];

  foreach ($pesquisadores as $key => $pesquisador) {
    $pesquisador = trim($conexao->escape_string($pesquisador));
    $sql = "INSERT INTO `$banco->relacaoUsuarioProjeto` (`idUsuario`, `idProjeto`) VALUES ($pesquisador, $id)";
    $inserir = $conexao->query($sql) or die($conexao->error);
  }

  header("Location: listarProjetos.php?editado");
?>