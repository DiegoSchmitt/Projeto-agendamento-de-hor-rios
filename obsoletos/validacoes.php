<?php
require 'agendamento.php';
if($tempo > 0 ) {
	if(date('w', strtotime($data)) != '0'){
		if($hora < date('H:i', strtotime('8.30')) or ($hora > date('H:i', strtotime('12.00')) && $hora < date('H:i', strtotime('13.00'))) or $hora > date('H:i', strtotime('20.00'))){
			echo "Ops, horário de trabalho das 8:30 até 12:00 e 13:00 até 20:00, agende o serviço entre esses horários!";
		}
	elseif($reservas->verificarDisponibilidade($data, $hora, $horafinal)){
		$reservas->reservar($data, $hora, $horafinal, $nome);
		echo "Agendamento realizado!";
		require 'calendario.php';
		exit;	
		}else{
			echo "Ops, data e horário já reservados, veja o calendário abaixo, selecione outro horário disponível!";;
		}
	}else{
		echo "Não trabalhamos em domingo, selecione outra data!";
	}
}
else {
	echo "Selecione ao menos um serviço a ser realizado!";
}
?>
<br/>
<a href="painelusuario.php">Voltar</a>
<?php
 require "calendario.php";