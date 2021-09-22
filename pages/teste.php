<!DOCTYPE html>
<html>
<head>
	<title>Barbearia</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
</head>
<body>
	<div class="container">
		 <nav class="navbar navbar-expand-lg navbar-light">
		 	<div class="navbar-brand"><img src="assets/imagens/capitaologo.png" width="100px"></div>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse menu" id="navbarMenu">
				<div class="navbar-nav">
					<a href="index.php" class="nav-item nav-link">Home</a>
					<a href="servicos.php" class="nav-item nav-link">Serviços</a>
					<a href="fotos.php" class="nav-item nav-link">Fotos</a>
		 </nav>
		 <h5>Bem vindo, <?php echo $_SESSION['nome']; ?></h5>
		<form method="POST">
			Quais serviços deseja:<br/>
			<input type="checkbox" name="servicos1" id="cmaquina" value="30"/>Corte com máquina
			<input type="checkbox" name="servicos2" id="ctesoura" value="30"/>Corte com tesoura
			<input type="checkbox" name="servicos3" id="cinfantil" value="30"/>Corte infantil
			<input type="checkbox" name="servicos4" id="btradicional" value="30"/>Barbear Tradicional
			<input type="checkbox" name="servicos5" id="bdesenhado" value="30"/>Barbear Desenhado
			<input type="checkbox" name="servicos6" id="bmaquina" value="30"/>Barbear com máquina
			<br/><br/>
			Escolha a data:
			<input type="date" name="data"/>

			Escolha o horário:
			<input type="time" name="hora"/><br/><br/>

			<input type="submit" value="Agendar">
		</form>
	</div>
	<script type="text/javascript" src="assets/js/JQuery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$reservas = new Reservas($pdo);
$servicos = new Servicos($pdo);

$lista = $reservas->getReservas();

$cmaquina = isset($_POST['servicos1'])?$_POST['servicos1']:0;
$ctesoura = isset($_POST['servicos2'])?$_POST['servicos2']:0;
$cinfantil = isset($_POST['servicos3'])?$_POST['servicos3']:0;
$btradicional = isset($_POST['servicos4'])?$_POST['servicos4']:0;
$bdesenhado = isset($_POST['servicos5'])?$_POST['servicos5']:0;
$bmaquina = isset($_POST['servicos6'])?$_POST['servicos6']:0;

$tempo = $cmaquina + $ctesoura + $cinfantil + $btradicional + $bdesenhado + $bmaquina;



foreach ($lista as $item) {
	$data = date('d/m/Y', strtotime($item['data']));
	$hora1 = $item['hora_inicial'];
	$item['hora_final'] = $hora1 + date('H:i', $tempo);
	$hora2 = $item['hora_final'];
	echo $item['nome'].' Dia '.$data.' agendou horário entre '.$hora1.' e '.$hora2."  ".$item['id_servico'].'<br/>';
}
