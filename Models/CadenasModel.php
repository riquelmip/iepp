<?php 

	class CadenasModel extends Mysql
	{
		private $intIdCadena;
		private $strDescripcion;
		private $strNombre;
		private $strCadena;
		private $strAutor;
		private $intEstado;
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
		
		public function selectCadenasAv()
		{
			$sql = "SELECT * FROM cadena WHERE tipocadena=1";
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectCorosAd()
		{
			$sql = "SELECT * FROM coro WHERE tipo=2";
					$request = $this->select_all($sql);
					return $request;
		}
		
		public function selectCadenasAd()
		{
			$sql = "SELECT * FROM cadena WHERE tipocadena=2";
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
		public function selectOnlyCadena(int $idcad){
			$this->intIdCadena = $idcad;
			$sql = "SELECT * FROM cadena
					WHERE idcadena = $this->intIdCadena";
			$request = $this->select($sql);
			return $request;
		}


		public function selectCadena(int $idcadena){
			$this->intIdCadena = $idcadena;
			$sql = "SELECT 
					dc.idcadena AS idcadena,
					c.nombre AS nombrecadena,
					c.tipocadena AS tipocadena,
					dc.idcoro AS idcoro,
					dc.num AS numero,
					co.nombre AS nombrecoro,
					co.coro AS coro
					FROM detallecadena dc
					INNER JOIN cadena c ON c.idcadena = dc.idcadena
					INNER JOIN coro co ON co.idcoro = dc.idcoro
					WHERE dc.idcadena= $idcadena
					GROUP BY dc.iddetalle
					ORDER BY dc.num";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectDetallesCadena(int $idcadena){
			$this->intIdCadena = $idcadena;
			$sql = "SELECT *
					FROM detallecadena
					WHERE idcadena= $idcadena";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectUltimaCadenaIngresada(){
			$sql = "SELECT * FROM cadena ORDER BY idcadena DESC LIMIT 1";
			$request = $this->select($sql);
			return $request;
		}
	
		public function insertCadena(string $nombre, int $tipo){

			$return = "";
			$this->strNombre = $nombre;
			$this->intTipo = $tipo;


			$sql = "SELECT * FROM cadena WHERE nombre = '{$this->strNombre}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO cadena(nombre, tipocadena) VALUES(?,?)";
	        	$arrData = array($this->strNombre, $this->intTipo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	
		public function insertDetalleCadena(string $idcoro, int $idcadena, int $num){

			$return = "";

				$query_insert  = "INSERT INTO detallecadena(idcadena, idcoro, num) VALUES(?,?,?)";
	        	$arrData = array($idcadena, $idcoro, $num);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			
			return $return;
		}	

	

		public function editCadena(int $idCadena, string $nombre, int $tipo){
			$this->strNombre = $nombre;
			$this->intIdCadena = $idCadena;
			$this->intTipo = $tipo;

			$sql = "SELECT * FROM cadena WHERE nombre = '{$this->strNombre}' AND idcadena !=  $this->intIdCadena";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE cadena SET nombre = ? WHERE idcadena =  $this->intIdCadena";
				$arrData = array($this->strNombre);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCadena(int $intidcadena)
		{
			$this->intIdCadena = $intidcadena;
			$sql = "DELETE FROM cadena WHERE idcadena = $this->intIdCadena ";
			$request = $this->delete($sql);
			return $request;
		}
		public function deleteDetallesCadena(int $intidcadena)
		{
			$this->intIdCadena = $intidcadena;
			$sql = "DELETE FROM detallecadena WHERE idcadena = $this->intIdCadena ";
			$request = $this->delete($sql);
			return $request;
		}

	}
 ?>