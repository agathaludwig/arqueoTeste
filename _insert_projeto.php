<?php
    $nomeDaInclude1 = "criaClasseBanco.inc.php";
    require_once $nomeDaInclude1;

    $banco = new Banco();
    $conexao = $banco->conectar();
    $banco->definirCharset($conexao);
    $banco->criarBanco($conexao);
    $banco->usaBanco($conexao);
    $banco->criaTabela($conexao);

    $acronimo = trim($conexao->escape_string($_POST["acronimo"]));
    $nome = trim($conexao->escape_string($_POST["nome"]));
    $coordenador = trim($conexao->escape_string($_POST["coordenador"]));
    $status = trim($conexao->escape_string($_POST["status"]));

  // INSERT TABELA PROJETOS
    $sql = "INSERT INTO `$banco->tabelaProjetos` (`acronimo`, `nome`, `coordenador`, `status`) VALUES ('$acronimo','$nome', $coordenador, $status)";
    $inserir = $conexao->query($sql) or die($conexao->error);

  // INSERT TABELA USUARIO_PROJETO
    $id = mysqli_insert_id($conexao); 
    $pesquisadores = $_POST["pesquisadores"];

    foreach ($pesquisadores as $key => $pesquisador) {
        $pesquisador = trim($conexao->escape_string($pesquisador));
        $sql = "INSERT INTO `$banco->relacaoUsuarioProjeto` (`idUsuario`, `idProjeto`) VALUES ($pesquisador, $id)";
        $inserir = $conexao->query($sql) or die($conexao->error);
    }
    header("Location: listarProjetos.php?inserido"); 
?>