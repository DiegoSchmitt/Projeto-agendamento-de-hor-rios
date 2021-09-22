<?php
require 'config.php';
if (isset($_POST['nome']) && !empty($_POST['nome'])) {
	$nome = addslashes($_POST['nome']);
	$senha = md5(addslashes($_POST['senha']));
	try {
		$db = new PDO($dsn, $dbuser, $dbpass);
		$sql = $db->query("SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'");
		if ($sql->rowCount() > 0) {
			$dado = $sql->fetch();
			$_SESSION['id'] = $dado['id'];
				header("Location: painelusuario.php");
				$_SESSION['nome'] = $nome;
			}
			else{
			?>
				<script>alert("usuario e/ou senha inválidos!")</script>
			<?php
			}
		}catch(PDOExcepition $e){
			echo "falhou: ".$e->getMessage();
	}
}
?>					