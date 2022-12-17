<?php 

	class AlabanzasModel extends Mysql
	{
		private $intIdAlabanza;
		//private $intNumhimnario;
		private $strNombre;
		private $strAlabanza;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectAlabanzas()
		{
			$sql = "SELECT * FROM alabanza";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectAlabanzaC(int $idalabanza){
			$this->intIdAlabanza = $idalabanza;
			$sql = "SELECT * FROM alabanza
					WHERE id = $this->intIdAlabanza";
			$request = $this->select($sql);
			return $request;
		}
	
		public function insertAlabanzaC(string $nombre, string $alabanza){

			$return = "";
			$this->strNombre = $nombre;
			$this->strAlabanza = $alabanza;

			$sql = "SELECT * FROM alabanza WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO alabanza(nombre,alabanza) VALUES(?,?)";
	        	$arrData = array($this->strNombre, $this->strAlabanza);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateAlabanzaC(int $idAlabanza, string $nombre, string $alabanza){
			$this->intIdAlabanza = $idAlabanza;
			$this->strNombre = $nombre;
			$this->strAlabanza = $alabanza;

			$sql = "SELECT * FROM alabanza WHERE nombre = '$this->strNombre' AND id != $this->intIdAlabanza";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE alabanza SET  nombre = ?, alabanza = ? WHERE id = $this->intIdAlabanza ";
				$arrData = array($this->strNombre, $this->strAlabanza);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteAlabanzaC(int $intIdAlabanza)
		{
			$this->intIdAlabanza = $intIdAlabanza;
			$sql = "DELETE FROM alabanza WHERE id = $this->intIdAlabanza ";
			$request = $this->delete($sql);
			return $request;
		}

	}
 ?>