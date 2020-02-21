<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title> Lista de Peças Arqueológicas </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/bb54122f21.js" crossorigin="anonymous"></script>
    <style>
        tr,
        td {
            text-align: center;
        }
    </style>
    <script>
			function selecao(objCaixa)
				{
					//cria o objeto ajax
					var ajax = new XMLHttpRequest();

					//recebe o número da peça digitado no formulário
					var idProjeto = objCaixa.value;

					//monta a query string que fará o ajax  enviar o número da peça ao PHP via requisição get
					var dados = "numero-peca=" + numeroPeca;

					//abre o ajax - insere, depois do GET, o nome de uma rquivo em PHP que se encarregará de receber o número da peça do ajax e setar a propriedade do objeto $analise com este valor
					//ajax.open('GET', 'setaNumeroPeca.php?' + dados, true);

					//envia o ajax
					ajax.send(null);
				}
			</script>
</head>
<?php
$nomeDaInclude2 = "navbar.inc.php";
require_once $nomeDaInclude2;
?>

<body>
    <div class="container" style="margin: 40px auto">
        <?php

        $sql1 = "SELECT nome FROM `colecoes` WHERE idColecao = $idColecao ";
        $buscar1 = mysqli_query($conexao, $sql1);
        $array = mysqli_fetch_array($buscar1);
        $nomeColecao = $array['nome'];

        $sql1 = "SELECT nome FROM `colecoes` WHERE idColecao = $idColecao ";
        $buscar1 = mysqli_query($conexao, $sql1);
        $array = mysqli_fetch_array($buscar1);
        $nomeColecao = $array['nome'];

        ?>

        <h3> Selecione o Projeto e a Coleção </h3>
        <br>
        <div class="form-group">
            <label> Projeto </label>
            <select class="custom-select" name="coordenador">

                <?php
                $sql1 = "SELECT * FROM projetos";
                $buscar1 = $conexao->query($sql1);
                while ($row1 = $buscar1->fetch_array()) {
                    echo "<option value= '$row1[0]'> $row1[1] </option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label> Coleção </label>
            <select class="custom-select" name="coordenador" onchange="selecao(objCaixa)">

                <?php
                $sql1 = "SELECT * FROM projetos";
                $buscar1 = $conexao->query($sql1);
                while ($row1 = $buscar1->fetch_array()) {
                    echo "<option value= '$row1[0]'> $row1[1] </option>";
                }
                ?>
            </select>
        </div>






        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nro Catálogo</th>
                    <th scope="col">Localização</th>
                    <th scope="col">Profundidade</th>
                    <th scope="col">Decoração</th>
                    <th scope="col">Parte</th>
                    <th scope="col">Análise</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>

            <?php
            $sql2 = "SELECT * FROM `pecas` WHERE idColecao = $idColecao ORDER BY numCatalogo";
            $buscar2 = $conexao->query($sql2) or die($conexao->error);

            while ($array = mysqli_fetch_array($buscar2)) {

                $idPeca = $array['idPeca'];
                $numCatalogo = $array['numCatalogo'];
                $localizacao = $array['localizacao'];
                $profundidade = $array['profundidade'];
                $decoracao = $array['decoracao'];
                $parte = $array['parte'];
                $idAnalise = $array['idAnalise'];
            ?>
                <tr>
                    <td><?php echo $numCatalogo ?></td>
                    <td><?php echo $localizacao ?></td>
                    <td><?php echo $profundidade ?></td>
                    <td><?php echo $decoracao ?></td>
                    <td><?php echo $parte ?></td>

                    <td><?php
                        if ($idAnalise != null) {
                        ?> <a style="color: #0d9e00" href="analise.php?id=<?php echo $idAnalise ?>" target="_blank"><i class="fas fa-check"></i></a>
                        <?php } else {
                        ?> <a style="color: #f20000" href="cadastro_analise.php?idColecao=<?php echo $idColecao ?>&numCatalogo=<?php echo $numCatalogo ?>" target="_blank"><i class="fas fa-times"></i></a>
                        <?php } ?> </td>

                    <td><a class="btn btn-warning btn-sm" style="color:#fff" href="editarPeca.php?id=<?php echo $idPeca ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar</a>
                        <a class="btn btn-danger btn-sm" style="color:#fff" role="button" onclick="aviso(<?php echo " $idPeca, $idColecao" ?>)"><i class="far fa-trash-alt"></i>&nbsp;Remover</a>
                    </td>
                <?php } ?>
                </tr>
        </table>

        <div style="text-align: right">
            <a href="cadastro_peca.php?id=<?php echo $idColecao ?>" role="button" class="btn btn-sm btn-success">Cadastrar nova</a>
            <a href="listarColecoes.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
        </div>
    </div>

    <script>
        function aviso(idPeca, idColecao) {
            let resposta = confirm("Atenção! \nTem certeza que deseja remover esta peça? \nToda a análise também será removida.");

            if (resposta == true) {
                window.location.href = "_deletarPeca.php?idPeca=" + idPeca + "&idColecao=" + idColecao;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>