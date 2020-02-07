<?php
	class Banco {
		public $servidor = "localhost";
		public $usuario = "root";
		public $senha = "";

		public $nomeDoBanco = "arqueoTeste";
		public $tabelaUsuarios = "usuarios";
		public $tabelaProjetos = "projetos";
		public $relacaoUsuarioProjeto = "usuario_projeto";
		public $tabelaColecoes = "colecoes";
		public $tabelaPecas = "pecas";
		

		function conectar () {
			$conexao = new mysqli($this->servidor, $this->usuario, $this->senha) or exit($conexao->error);
			return $conexao;
		}

		function definirCharset($conexao) {
			$conexao->set_charset("utf8");
		}

		function criarBanco($conexao) {
			$sql = "CREATE DATABASE IF NOT EXISTS $this->nomeDoBanco";
			$conexao->query($sql) or exit($conexao->error);
		}

		function usaBanco($conexao) {
			$conexao->select_db($this->nomeDoBanco);
		}

		function criaTabela($conexao) {
			$sql = "CREATE TABLE IF NOT EXISTS $this->tabelaUsuarios (
			idUsuario INT AUTO_INCREMENT PRIMARY KEY,
			nomeUsuario VARCHAR (200) NOT NULL,
            emailUsuario VARCHAR (30) NOT NULL,
            loginUsuario VARCHAR (20) NOT NULL,
            senhaUsuario VARCHAR (150) NOT NULL,
            nivelUsuario INT (2) NOT NULL,
			dataCadastro TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP) 
			ENGINE=innoDB";
			$enviado = $conexao->query($sql) or exit($conexao->error);

			$sql = "CREATE TABLE IF NOT EXISTS $this->tabelaProjetos (
				`idProjeto` INT AUTO_INCREMENT PRIMARY KEY,
				`acronimo` VARCHAR(45) NOT NULL,
				`nome` VARCHAR(250) NOT NULL,
				`coordenador` INT NOT NULL,
				`status` INT(1) NOT NULL)
			  ENGINE = InnoDB";
			$enviado = $conexao->query($sql) or exit($conexao->error);  

			$sql = "CREATE TABLE IF NOT EXISTS $this->relacaoUsuarioProjeto (
				`id_usuario_projeto` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
				`idUsuario` INT,
				`idProjeto` INT,
				CONSTRAINT `fk_usuario_projeto_usuarios`
				  FOREIGN KEY (`idUsuario`)
				  REFERENCES `arqueoTeste`.`usuarios` (`idUsuario`)
				  ON DELETE NO ACTION
				  ON UPDATE NO ACTION,
				CONSTRAINT `fk_usuario_projeto_projetos1`
				  FOREIGN KEY (`idProjeto`)
				  REFERENCES `arqueoTeste`.`projetos` (`idProjeto`)
				  ON DELETE CASCADE
				  ON UPDATE CASCADE)
			  ENGINE = InnoDB";
			  $enviado = $conexao->query($sql) or exit($conexao->error);  

			  $sql = "CREATE TABLE IF NOT EXISTS $this->tabelaColecoes (
				`idColecao` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`idProjeto` INT NOT NULL,
				`nome` VARCHAR(100) NOT NULL,
				`tipo` INT NOT NULL,
				`numPecas` INT NOT NULL,
				`status` INT(1) NOT NULL,
				`tabelaNumeracao` VARCHAR(100) NULL,
				CONSTRAINT `fk_colecoes_projetos1`
				  FOREIGN KEY (`idProjeto`)
				  REFERENCES `arqueoTeste`.`projetos` (`idProjeto`)
				  ON DELETE CASCADE
				  ON UPDATE CASCADE)
			  ENGINE = InnoDB";
			$enviado = $conexao->query($sql) or exit($conexao->error);
			
			$sql = "CREATE TABLE IF NOT EXISTS $this->tabelaPecas (
				`idPeca` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`idColecao` INT NOT NULL,
				`numCatalogo` INT NOT NULL,
				`numFragmentos` INT NOT NULL,
				`localizacao` VARCHAR(40) NULL,
				`profundidade` VARCHAR(20) NULL,
				`numColeta` VARCHAR(20) NULL,
				`decoracao` VARCHAR(50) NULL,
				`parte` VARCHAR(50) NULL,
				`observacoes` VARCHAR(200) NULL,
				`idAnalise` INT NULL,
				CONSTRAINT `fk_pecas_colecoes1`
				  FOREIGN KEY (`idColecao`)
				  REFERENCES `arqueoTeste`.`colecoes` (`idColecao`)
				  ON DELETE CASCADE
				  ON UPDATE CASCADE)
			  ENGINE = InnoDB";
			$enviado = $conexao->query($sql) or exit($conexao->error);  
		}

		function desconectar($conexao) {
			$conexao->close();
		}
	}
