<?php
session_start();
require 'config.php';
require 'cadastro.php';
require 'login.php';
require 'classes/servicos.class.php';
require 'classes/reservas.class.php';
?>

<h1>Agendamento</h1>
<?php
$reservas = new Reservas($pdo);//cria um objeto e salva a conex�o.
$servicos = new Servicos($pdo);

$lista = $reservas->getReservas($hora_inicial, $hora_final);//armazena as reservas na vri�vel lista.

$cmaquina = isset($_POST['servicos1'])?$_POST['servicos1']:0;
$ctesoura = isset($_POST['servicos2'])?$_POST['servicos2']:0;
$cinfantil = isset($_POST['servicos3'])?$_POST['servicos3']:0;
$btradicional = isset($_POST['servicos4'])?$_POST['servicos4']:0;
$bdesenhado = isset($_POST['servicos5'])?$_POST['servicos5']:0;
$bmaquina = isset($_POST['servicos6'])?$_POST['servicos6']:0;
$hora = isset($_POST['hora'])?$_POST['hora']:"Prencha o campo hora!";
$data = isset($_POST['data'])?$_POST['data']:"Prencha o campo data!";
$tempo = $cmaquina + $ctesoura + $cinfantil + $btradicional + $bdesenhado + $bmaquina;
$horafinal= date('H:i:s', strtotime($hora.'+'. $tempo .'minutes')-0.1);
$nome = $_SESSION['nome'];



if($tempo > 0 ) {
	if(date('w', strtotime($data)) != '0'){
		if($hora < date('H:i', strtotime('8.30')) or ($hora > date('H:i', strtotime('12.00')) && $hora < date('H:i', strtotime('13.00'))) or $hora > date('H:i', strtotime('20.00'))){
			echo "Ops, hor�rio de trabalho das 8:30 at� 12:00 e 13:00 at� 20:00, agende o servi�o entre esses hor�rios!";
		}
	elseif($reservas->verificarDisponibilidade($data, $hora, $horafinal)){
		$reservas->reservar($data, $hora, $horafinal, $nome);
		echo "Agendamento realizado!";
		require 'calendario.php';
		exit;	
		}else{
			echo "Ops, data e hor�rio j� reservados, veja abaixo os hor�rios j� reservados, selecione outro hor�rio dispon�vel!<br><br>";

			header("Location:agendados.php");

		}
	}else{
		echo "N�o trabalhamos em domingo, selecione outra data!";
	}
}
else {
	echo "Selecione ao menos um servi�o a ser realizado!";
}
echo "<br/><br/>";

$lista = $reservas->getReservas();//armazena as reservas na vri�vel lista.

$diadasemana = date('w');
switch ($diadasemana) {
	case '1':
		$diadasemana = 'Segunda';
	break;
	case '2':
		$diadasemana = 'Ter�a';
	break;
	case '3':
		$diadasemana = 'Quarta';
	break;
	case '4':
		$diadasemana = 'Quinta';
	break;
	case '5':
		$diadasemana = 'Sexta';
	break;
	case '6':
		$diadasemana = 'Sabado';
	break;
}

/*
foreach ($lista as $item) {
	$dataBD = date('d/m/Y', strtotime($item['data']));
	$horainicialBD = $item['hora_inicial'];
	$horafinalBD = $item['hora_final'];
	echo $item['nome'].' Dia '.$dataBD.' agendou hor�rio entre '.$horainicialBD.' e '.$horafinalBD."  ".'<br/>';
}
*/
?>
<br/>
<a href="painelusuario.php">Voltar</a>
