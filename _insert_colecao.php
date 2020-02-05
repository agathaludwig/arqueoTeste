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
$nome = trim($conexao->escape_string($_POST["nome"]));
$tipo = trim($conexao->escape_string($_POST["tipo"]));
$numPecas = trim($conexao->escape_string($_POST["numPecas"]));
$status = trim($conexao->escape_string($_POST["status"]));

$extensao = strtolower(substr($_FILES['tabelaNumeracao']['name'], -4));
$nomelimpo = str_replace(" ", "", strtolower($nome));
$novoNome = $idProjeto . $nomelimpo . $extensao;
$diretorio = 'upload/';

if ($_FILES['tabelaNumeracao']['size'] == 0) {
    $sql1 = "INSERT INTO `$banco->tabelaColecoes` (`idProjeto`, `nome`, `tipo`, `numPecas`,  `status`) VALUES ($idProjeto,'$nome', $tipo, $numPecas, $status)";
    $inserirSemTabela = $conexao->query($sql1) or die($conexao->error);
    header("Location: listarColecoes.php?inserido");
} else {
    if ($extensao == ".csv") {
         $sql2 = "INSERT INTO `$banco->tabelaColecoes` (`idProjeto`, `nome`, `tipo`, `numPecas`,  `status`,`tabelaNumeracao`) VALUES ($idProjeto,'$nome', $tipo, $numPecas, $status, '$diretorio$novoNome')";
         $inserirComTabela = $conexao->query($sql2) or die($conexao->error);
         $idColecao = mysqli_insert_id($conexao); 
         move_uploaded_file($_FILES['tabelaNumeracao']['tmp_name'], $diretorio.$novoNome);

         // carregamento de csv para bd_pecas
        $file = fopen($diretorio.$novoNome, "r");

        while(! feof($file)) {
            $line = fgets($file);
            $array = explode(",", $line);
            
            $numCatalogo    = $array[0];
            $numFragmentos  = $array[1];
            $localizacao    = $array[2];
            $profundidade   = $array[3];
            $numColeta      = $array[4];
            $decoracao      = $array[5];
            $parte          = $array[6];
            $observacoes    = $array[7];

            $sql3 = "INSERT INTO `$banco->tabelaPecas` (`idColecao`, `numCatalogo`, `numFragmentos`, `localizacao`, `profundidade`, `numColeta`, `decoracao`, `parte`, `observacoes`) VALUES ($idColecao, $numCatalogo, $numFragmentos, '$localizacao', '$profundidade', '$numColeta', '$decoracao', '$parte', '$observacoes')";
            $inserir = $conexao->query($sql3) or die($conexao->error);
            }

        fclose($file);

        header("Location: listarColecoes.php?inserido");
    } else {
        header("Location: cadastro_colecao.php?invalido");
    }
}
