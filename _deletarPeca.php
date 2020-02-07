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

    $idPeca = $_GET['idPeca'];
    $idColecao = $_GET['idColecao'];

    $sql1 = "DELETE FROM $banco->tabelaPecas WHERE idPeca = $idPeca";
    $removerPeca = $conexao->query($sql1) or die($conexao->error);

  header("Location: listarPecas.php?removido&id=$idColecao"); 
?>