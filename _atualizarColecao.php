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

$idColecao = $_POST['idColecao'];
$idProjeto = $_POST['idProjeto'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$numPecas = $_POST['numPecas'];
$status = $_POST['status'];
$tabelaNumeracao = $_POST['tabelaNumeracao'];

if (empty($_FILES['tabelaNumeracao']['name'])) {
  // Atualiza dados sem alterar tabela de numeração
  $sql1 = "UPDATE `colecoes` SET `idProjeto`=$idProjeto, `nome`='$nome', `tipo`=$tipo, `numPecas`=$numPecas,`status`=$status WHERE idColecao = $idColecao";
  $atualizarSemTabela = $conexao->query($sql1) or die($conexao->error);
} else {
  $extensao = strtolower(substr($_FILES['tabelaNumeracao']['name'], -4));
  $nomelimpo = str_replace(" ", "", strtolower($nome));
  $novoNome = $idProjeto . $nomelimpo . $extensao;
  $diretorio = 'upload/';

  if ($extensao == ".csv") {
    
    // Atualiza dados E tabela de numeração
    $sql2 = "UPDATE `colecoes` SET `idProjeto`=$idProjeto, `nome`='$nome', `tipo`=$tipo, `numPecas`=$numPecas,`status`=$status, `tabelaNumeracao`='$diretorio$novoNome' WHERE idColecao = $idColecao";
    $atualizarComTabela = $conexao->query($sql2) or die($conexao->error);

    // verifica se tem peças desta coleção 
    $sql3 = "SELECT * FROM $banco->tabelaPecas WHERE idColecao = $idColecao";
    $busca = $conexao->query($sql3) or die($conexao->error);
    if ($busca != 0) {
      // Remove todas peças da tabela anterior
      $sql4 = "DELETE FROM $banco->tabelaPecas WHERE idColecao = $idColecao";
      $removerTodos = $conexao->query($sql4) or die($conexao->error);
    }

    // Insere a nova tabela
    move_uploaded_file($_FILES['tabelaNumeracao']['tmp_name'], $diretorio . $novoNome);

    $file = fopen($diretorio . $novoNome, "r");

    while (!feof($file)) {
      $line = fgets($file);
      $array = explode(",", $line);
      // echo "<pre";
      // print_r($array);
      // echo "</pre";

      $numCatalogo    = $array[0];
      $numFragmentos  = $array[1];
      $localizacao    = $array[2];
      $profundidade   = $array[3];
      $numColeta      = $array[4];
      $decoracao      = $array[5];
      $parte          = $array[6];
      $observacoes    = $array[7];

      echo $sql5 = "INSERT INTO `$banco->tabelaPecas` (`idColecao`, `numCatalogo`, `numFragmentos`, `localizacao`, `profundidade`, `numColeta`, `decoracao`, `parte`, `observacoes`) VALUES ($idColecao, $numCatalogo, $numFragmentos, '$localizacao', '$profundidade', '$numColeta', '$decoracao', '$parte', '$observacoes')";
      $inserirPecas = $conexao->query($sql5) or die($conexao->error);
    }
  } else {
    header("Location: cadastro_colecao.php?invalido");
  }
}

fclose($file);
header("Location: listarColecoes.php?editado");
