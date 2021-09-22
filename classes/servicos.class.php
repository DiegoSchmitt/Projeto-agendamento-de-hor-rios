<?php
class Servicos{
	private $pdo;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function getServicos(){
		$array = array();

		$sql = "SELECT * FROM servicos";
		$sql = $this->pdo->query($sql);

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
} 
?>