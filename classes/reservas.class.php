<?php
class Reservas{

	private $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}
	public function getReservas($data){//retorna os agendamentos do banco de dados
		$array = array();

		$sql = "SELECT * FROM reservas WHERE data = :data ORDER BY hora";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":data", $data);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;		
	}
	public function verificarDisponibilidade($data, $hora, $hora_final){
		$sql = "SELECT * FROM reservas WHERE data = :data AND (NOT(hora > :hora_final or hora_final < :hora))";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":data", $data);
		$sql->bindValue(":hora", $hora);
		$sql->bindValue(":hora_final", $hora_final);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return false;
		}else{
			return true;
		}
	}


	public function reservar($id_servico, $data, $hora, $nome, $hora_final){
		$sql = "INSERT INTO reservas(id_servico, data, hora, nome, hora_final) VALUES (:id_servico, :data, :hora, :nome, :hora_final)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_servico", $id_servico);
		$sql->bindValue(":data", $data);
		$sql->bindValue(":hora", $hora);
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":hora_final", $hora_final);

		$sql->execute();

	}
}
?>