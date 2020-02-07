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

$idColecao = trim($conexao->escape_string($_POST["idColecao"]));
$idPeca = trim($conexao->escape_string($_POST["idPeca"]));
$numCatalogo = trim($conexao->escape_string($_POST["numCatalogo"]));
$numFragmentos = trim($conexao->escape_string($_POST["numFragmentos"]));
$numColeta = trim($conexao->escape_string($_POST["numColeta"]));
$localizacao = trim($conexao->escape_string($_POST["localizacao"]));
$profundidade = trim($conexao->escape_string($_POST["profundidade"]));
$decoracao = trim($conexao->escape_string($_POST["decoracao"]));
$parte = trim($conexao->escape_string($_POST["parte"]));
$observacoes = trim($conexao->escape_string($_POST["observacoes"]));


// UPDATE TABELA PROJETOS
$sql = "UPDATE `$banco->tabelaPecas` SET `numCatalogo`= $numCatalogo, `numFragmentos`=$numFragmentos, `numColeta`='$numColeta', `localizacao`='$localizacao', `profundidade`='$profundidade', `decoracao`='$decoracao', `parte` ='$parte', `observacoes`='$observacoes' WHERE idPeca = $idPeca";
$atualizar = $conexao->query($sql) or die($conexao->error);

header("Location: listarPecas.php?editado&id=$idColecao");
