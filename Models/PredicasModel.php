<?php 

	class PredicasModel extends Mysql
	{
		private $intIdPredica;
		//private $intNumhimnario;
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
	
		public function insertPredica(string $nombre, string $Predica){

			$return = "";
			$this->strNombre = $nombre;
			$this->strPredica = $Predica;

			$sql = "SELECT * FROM predica WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO predica(nombre,predica) VALUES(?,?)";
	        	$arrData = array($this->strNombre, $this->strPredica);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updatePredica(int $idPredica, string $nombre, string $Predica){
			$this->intIdPredica = $idPredica;
			$this->strNombre = $nombre;
			$this->strPredica = $Predica;

			$sql = "SELECT * FROM predica WHERE nombre = '$this->strNombre' AND id != $this->intIdPredica";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE predica SET  nombre = ?, predica = ? WHERE id = $this->intIdPredica ";
				$arrData = array($this->strNombre, $this->strPredica);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deletePredica(int $intIdPredica)
		{
			$this->intIdPredica = $intIdPredica;
			$sql = "DELETE FROM predica WHERE id = $this->intIdPredica ";
			$request = $this->delete($sql);
			return $request;
		}

	}
 ?>