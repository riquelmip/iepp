<?php 

	class CorosModel extends Mysql
	{
		private $intIdCoro;
		private $strNombre;
		private $strCoro;
		private $intTipo;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectCorosAv()
		{
			$sql = "SELECT * FROM coro WHERE tipo=1";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectCorosAd()
		{
			$sql = "SELECT * FROM coro WHERE tipo=2";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectCoro(int $idcoro){
			$this->intIdCoro = $idcoro;
			$sql = "SELECT * FROM coro
					WHERE idcoro = $this->intIdCoro";
			$request = $this->select($sql);
			return $request;
		}
	
		public function insertCoro(string $nombre, string $coro, int $tipo){

			$return = "";
			$this->strNombre = $nombre;
			$this->strCoro = $coro;
			$this->intTipo = $tipo;

			$sql = "SELECT * FROM coro WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO coro(nombre,coro,tipo) VALUES(?,?,?)";
	        	$arrData = array($this->strNombre, $this->strCoro, $this->intTipo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateCoro(int $idCoro, string $nombre, string $coro, int $tipo){
			$this->intIdCoro= $idCoro;
			$this->strNombre = $nombre;
			$this->strCoro= $coro;
			$this->intTipo = $tipo;

			$sql = "SELECT * FROM coro WHERE nombre = '$this->strNombre'  AND idcoro != $this->intIdCoro";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE coro SET nombre = ?, coro = ?, tipo = ?  WHERE idcoro = $this->intIdCoro ";
				$arrData = array($this->strNombre, $this->strCoro, $this->intTipo);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCoro(int $intidcoro)
		{
			$this->intIdCoro = $intidcoro;
			$sql = "DELETE FROM coro WHERE idcoro = $this->intIdCoro ";
			$request = $this->delete($sql);
			return $request;
		}

	}
 ?>