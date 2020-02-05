<?php
    $nomeDaInclude1 = "criaClasseBanco.inc.php";
    require_once $nomeDaInclude1;

    $banco = new Banco();
    $conexao = $banco->conectar();
    $banco->definirCharset($conexao);
    $banco->criarBanco($conexao);
    $banco->usaBanco($conexao);
    $banco->criaTabela($conexao);

    $nomeusuario = trim($conexao->escape_string($_POST["nomeusuario"]));
    $emailusuario = trim($conexao->escape_string($_POST["emailusuario"]));
    $loginusuario = trim($conexao->escape_string($_POST["loginusuario"]));
    $senhausuario = trim($conexao->escape_string($_POST["senhausuario"]));
    $nivelusuario = trim($conexao->escape_string($_POST["nivelusuario"]));
    $senhadecodificada = hash('sha512', $senhausuario);

    $sql = "INSERT INTO `$banco->tabelaUsuarios`(`nomeusuario`, `emailusuario`, `loginusuario`, `senhausuario`, `nivelusuario`) VALUES ('$nomeusuario','$emailusuario', '$loginusuario', '$senhadecodificada', $nivelusuario)";

    $inserir = $conexao->query($sql) or die($conexao->error);

    header("Location: listarUsuarios.php?inserido"); 

?>