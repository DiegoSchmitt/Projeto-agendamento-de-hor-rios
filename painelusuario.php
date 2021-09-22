<?php
require 'classes/servicos.class.php';
require 'classes/reservas.class.php';
require 'classes/horarios.class.php';
require 'pages/header.php';
require 'config.php';

$reservas = new Reservas($pdo);
$servicos = new Servicos($pdo);
$horarios = new Horarios($pdo);
$nome = $_SESSION['nome'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Barbearia</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
</head>
<body>
	<div class="container">
		 <h5>Bem vindo, <?php echo $_SESSION['nome']; ?></h5>

		<h1>Adicionar reserva</h1>
<form action="" method="post">
    Selecione o serviço: <br>
    <select name="servico">
        <option></option>
        <?php
        $lista = $servicos->getServicos();
        foreach($lista as $servicos):
            ?>
            <option value="<?php echo $servicos['id'].'-'.$servicos['tempo'];?>">   
                <?php 
                    echo $servicos['tipo'];
                ?>  
            </option>
            <?php
        endforeach;
        ?>


    </select><br><br>

    Data:
    <input type="date" name="data"><br><br>

    Horário:
    <!--<input type="time" name="hora" min="08:00" max="18:00"><br><br>-->
    <select name="hora">
    <option></option>
        <?php
        $listahorarios = $horarios->getHorarios();
        foreach($listahorarios as $horarios):
            ?>
            <option>   
                <?php 
                    echo $horarios['horario'];
                ?>  
            </option>
            <?php
        endforeach;
        ?>
    </select> <br><br>

    <input type="submit" value="Reservar">
    </form>

	</div>
</body>
</html>
<?php
if(!empty($_POST['servico'])){
    $servico = addslashes($_POST['servico']);
    $servico_explode = explode('-', $servico);
    $id_servico =  $servico_explode[0];
    $tempo_servico = $servico_explode[1];
    $data = addslashes($_POST['data']);
    $hora = addslashes($_POST['hora']);
    $hora_final = date('H:i:s',strtotime($hora. '+' .$tempo_servico.'minutes'));
    $hora_final = date('H:i:s',strtotime($hora_final. '- 1 seconds'));
    $d = explode("-", $data);
    $h = explode(":", $hora);
    if(date('w', strtotime($data)) !='0'){
        if(mktime($h[0], $h[1], 0,  intval($d[1]), intval($d[2]),intval($d[0])) > time()){
            if($reservas->verificardisponibilidade($data, $hora, $hora_final)){
                $reservas->reservar($id_servico, $data, $hora, $nome, $hora_final);
                    echo "Agendamento realizado com sucesso!";
            }else{
		        echo "Já existe serviço agendado para esse horário.<br/>
                Veja a lista de horários agendados para o dia.<br/><br/>";
                $lista = $reservas->getReservas($data);
    ?>
                <h3>Horários agendados</h3>
                <table border='1'>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Hora inicial</th>
                            <th>Hora final</th>
                        </tr>
                    </thead>
                <tbody>
                <?php
                    foreach($lista as $item):
                ?>
                <tr>
                    <td><?=$item['nome']?></td>        
                    <td><?=$item['hora']?></td>
                    <td><?=date('H:i:s',strtotime($item['hora_final']. '+ 1 seconds'))?></td>
                </tr>
                <?php
                    endforeach;
                ?>
                </tbody>
                </table>

                <h3>Horários livres</h3>
    <?php
                $inicio_manha = mktime(8, 0, 0, $d[1], $d[2], $d[0]);
                $fim_manha = mktime(12, 0, 0, $d[1], $d[2], $d[0]);
                $inicio_tarde = mktime(13, 0, 0, $d[1], $d[2], $d[0]);
                $fim_tarde = mktime(18, 0, 0, $d[1], $d[2], $d[0]);
                foreach($lista as $item){
                    $i = explode(":", $item['hora']);
                    $f = explode(":", $item['hora_final']);
                    $i = mktime($i[0], $i[1], $i[2], $d[1], $d[2], $d[0]);
                    $f = mktime($f[0], $f[1], $f[2], $d[1], $d[2], $d[0]);
                    echo $i;
                }
            }
        }
        else{
            echo 'Ops, Horário não pode ser menor que o horário atual';
        }
    }
    else{
        echo 'Ops, não trabalhamos aos Domingos, favor escolha outra data!';
    }

}
?>



















