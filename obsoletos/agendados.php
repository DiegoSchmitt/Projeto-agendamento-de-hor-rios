<?php
require 'config.php';
require 'classes/servicos.class.php';
require 'classes/reservas.class.php';
$reservas = new Reservas($pdo);//cria um objeto e salva a conex�o.
$servicos = new Servicos($pdo);
?>
<h3>Já existe um agendamento nesse horário. Use a ferramenta abaixo para filtrar os horários disponíveis.</h3>

<form method="GET">
Ano:
<select name="ano">
		<option><?php echo date('y'); ?></option>
		<option><?php echo date('y')+1; ?></option>
</select>
Mes:
<select name="mes">
		<option><?php echo date('m'); ?></option>
		<option><?php echo date('m')+1; ?></option>
</select>
Dia:
<select name="dia">
		<?php 
		for($q=1; $q<=31; $q++):?>
		<option><?php echo $q; ?></option>
		<?php endfor; ?>
</select>
Hora:
<select name="hora">
	<option value='8'>8:00</option>
	<option value='9'>9:00</option>
	<option value='10'>10:00</option>
	<option value='11'>11:00</option>
	<option value='13'>13:00</option>
	<option value='14'>14:00</option>
	<option value='15'>15:00</option>
	<option value='16'>16:00</option>
	<option value='17'>17:00</option>
	<option value='18'>18:00</option>
	<option value='19'>19:00</option>
</select>
	<input type="submit" value="Mostrar">
</form>
<?php
if(empty($_GET['ano'])){
	exit;
}
$hora_inicial = $_GET['hora'];
$hora_final = date('H:i', strtotime('+1', strtotime($_GET['hora'])));


echo $hora_inicial."<br/>";
echo $hora_final."<br/>";

$lista = $reservas->getReservas($hora_inicial, $hora_final);

foreach($lista as $item){
	echo 'Há serviço agendado nesse horário'.$item['hora_inicial']." e ".$item['hora_final'];
}
