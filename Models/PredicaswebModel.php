<?php 

	class PredicaswebModel extends Mysql
	{
		private $intIdPredica;
		private $strNombre;
		private $strPredica;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectPredicas()
		{
			$sql = "SELECT * FROM predica";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectPredica(int $idPredica){
			$this->intIdPredica = $idPredica;
			$sql = "SELECT * FROM predica
					WHERE id = $this->intIdPredica";
			$request = $this->select($sql);
			return $request;
		}
	
	}
 ?>