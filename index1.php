<?php

    $nomeDaInclude1 = "criaClasseBanco.inc.php";
    require_once $nomeDaInclude1;

    $banco = new Banco();
    $conexao = $banco->conectar();
    $banco->definirCharset($conexao);
    $banco->criarBanco($conexao);
    $banco->usaBanco($conexao);
    $banco->criaTabela($conexao);

    $usuario = trim($conexao->escape_string($_POST["usuario"]));
    $senhainformada = trim($conexao->escape_string($_POST["senha"]));

    $sql = "SELECT loginUsuario, senhaUsuario FROM $banco->tabelaUsuarios WHERE loginUsuario = '$usuario' ";
    $buscar = $conexao->query($sql) or die($conexao->error);

    $total = mysqli_num_rows($buscar);

    if ($total == 0) {
        echo 'teste';
        header("Location: erro.php");
    }
    else {
        while ($array = mysqli_fetch_array($buscar)) {
            $senha = $array['senhaUsuario'];
            $senhadecodificada = hash('sha512', $senhainformada);
            
            if ($senha == $senhadecodificada) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: menu.php");    
            }
            else {
                header("Location: erroSenha.php");
            }
            
        }
    }       
    $banco->desconectar($conexao);
?>