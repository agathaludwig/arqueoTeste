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

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<div class="container" style="width: 500px; margin-top: 20px">
    <center>
        <h4>Usuário cadastrado com sucesso! </h4>
    </center>
    <div style="text-align: right; padding-top: 20px">
      <a href="cadastro_usuario.php" role="button" class="btn btn-sm btn-primary">Cadastrar novo</a>
      <a href="menu.php" role="button" class="btn btn-sm btn-success">Menu</a>
    </div>
        </center>
    </div>
</div>