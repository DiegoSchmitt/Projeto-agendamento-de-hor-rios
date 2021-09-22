<?php
class Horarios{
	private $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function getHorarios(){
		$array = array();

		$sql = "SELECT * FROM horarios";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}

} 
?>

