<?php
	class Banco {
		public $servidor = "localhost";
		public $usuario = "root";
		public $senha = "";

		public $nomeDoBanco = "arqueoTeste";
		public $tabelaUsuarios = "usuarios";

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
		}

		function desconectar($conexao) {
			$conexao->close();
		}
	}
?>