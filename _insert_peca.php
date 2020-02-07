<?php
$nomeDaInclude1 = "criaClasseBanco.inc.php";
require_once $nomeDaInclude1;

$banco = new Banco();
$conexao = $banco->conectar();
$banco->definirCharset($conexao);
$banco->criarBanco($conexao);
$banco->usaBanco($conexao);
$banco->criaTabela($conexao);

$idProjeto = trim($conexao->escape_string($_POST["idProjeto"]));
$idColecao = trim($conexao->escape_string($_POST["idColecao"]));
$numCatalogo = trim($conexao->escape_string($_POST["numCatalogo"]));
$numFragmentos = trim($conexao->escape_string($_POST["numFragmentos"]));
$numColeta = trim($conexao->escape_string($_POST["numColeta"]));
$localizacao = trim($conexao->escape_string($_POST["localizacao"]));
$profundidade = trim($conexao->escape_string($_POST["profundidade"]));
$decoracao = trim($conexao->escape_string($_POST["decoracao"]));
$parte = trim($conexao->escape_string($_POST["parte"]));
$observacoes = trim($conexao->escape_string($_POST["observacoes"]));

$sql = "INSERT INTO `$banco->tabelaPecas` (`idColecao`, `numCatalogo`, `numFragmentos`, `localizacao`, `profundidade`, `numColeta`, `decoracao`, `parte`, `observacoes`) VALUES ($idColecao, $numCatalogo, $numFragmentos, '$localizacao', '$profundidade', '$numColeta', '$decoracao', '$parte', '$observacoes')";
$inserir = $conexao->query($sql) or die($conexao->error);

header("Location: listarPecas.php?inserido&id=$idColecao");