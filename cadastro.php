<?php
require 'config.php';
	if(isset($_POST['telefone']) && !empty($_POST['telefone']) && isset($_POST['nome']) && !empty($_POST['nome'])){
		$nome = addslashes($_POST['nome']);
		$email = addslashes($_POST['email']);
		$telefone = addslashes($_POST['telefone']);
		$senha = md5(addslashes($_POST['senha']));

		$sql = "INSERT INTO usuarios SET nome = '$nome', email = '$email', telefone = '$telefone', senha = '$senha'";

		$pdo->query($sql);

		header("Location: painelusuario.php");
		$_SESSION['nome'] = $nome;
}

