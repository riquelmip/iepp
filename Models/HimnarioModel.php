<?php 

	class HimnarioModel extends Mysql
	{
		private $intIdAlabanza;
		private $intNumhimnario;
		private $strNombre;
		private $strAlabanza;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectHimnario()
		{
			$sql = "SELECT * FROM himnario";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectAlabanza(int $idalabanza){
			$this->intIdAlabanza = $idalabanza;
			$sql = "SELECT * FROM himnario
					WHERE idalabanza = $this->intIdAlabanza";
			$request = $this->select($sql);
			return $request;
		}
	
		public function insertAlabanza(int $numHimnario, string $nombre, string $alabanza){

			$return = "";
			$this->intNumhimnario = $numHimnario;
			$this->strNombre = $nombre;
			$this->strAlabanza = $alabanza;

			$sql = "SELECT * FROM himnario WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO himnario(numhimnario,nombre,alabanza) VALUES(?,?,?)";
	        	$arrData = array($this->intNumhimnario, $this->strNombre, $this->strAlabanza);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateAlabanza(int $idAlabanza, int $numHimnario, string $nombre, string $alabanza){
			$this->intIdAlabanza = $idAlabanza;
			$this->intNumhimnario = $numHimnario;
			$this->strNombre = $nombre;
			$this->strAlabanza = $alabanza;

			$sql = "SELECT * FROM himnario WHERE nombre = '$this->strNombre' AND idalabanza != $this->intIdAlabanza";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE himnario SET numhimnario = ?, nombre = ?, alabanza = ? WHERE idalabanza = $this->intIdAlabanza ";
				$arrData = array($this->intNumhimnario, $this->strNombre, $this->strAlabanza);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteAlabanza(int $intIdAlabanza)
		{
			$this->intIdAlabanza = $intIdAlabanza;
			$sql = "DELETE FROM himnario WHERE idalabanza = $this->intIdAlabanza ";
			$request = $this->delete($sql);
			return $request;
		}

	}
 ?>