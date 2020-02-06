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

    $id = $_GET['id'];

    $sql1 = "DELETE FROM $banco->tabelaColecoes WHERE idColecao = $id";
    $removerColecao = $conexao->query($sql1) or die($conexao->error);

    $sql2 = "DELETE FROM $banco->tabelaPecas WHERE idColecao = $id";
    $removerPecas = $conexao->query($sql2) or die($conexao->error);

  header("Location: listarColecoes.php?removido"); 
?>