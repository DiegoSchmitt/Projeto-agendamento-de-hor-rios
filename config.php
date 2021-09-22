<?php
$dsn = "mysql:dbname=agendamento_de_clientes;host=localhost";
$dbuser ="root";
$dbpass =""; 

try {
	$pdo = new PDO($dsn, $dbuser, $dbpass);
}catch(PDOException $e) {
	echo "falhou a conexão";
}
?>