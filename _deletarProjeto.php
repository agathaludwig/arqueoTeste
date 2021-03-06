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

    $sql = "DELETE FROM `projetos` WHERE idProjeto = $id";
    $deletar = $conexao->query($sql) or die($conexao->error);

    header("Location: listarProjetos.php?removido"); 
?>