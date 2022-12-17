<?php 

	class CadenaswebModel extends Mysql
	{
		private $intId;
		private $strNombre;
		private $strDescripcion;
		private $strCadena;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectCadenasAv()
		{
			$sql = "SELECT * FROM cadena WHERE tipocadena=1";
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectCadenasAd()
		{
			$sql = "SELECT * FROM cadena WHERE tipocadena=2";
					$request = $this->select_all($sql);
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

		public function selectDetalleNombreCoroCadena(int $idcadena){
			$this->intIdCadena = $idcadena;
			$sql = "SELECT
					c.idcadena,
					c.nombre AS nombrecadena,
					c.tipocadena,
					dc.idcoro,
					co.nombre AS nombrecoro,
					co.coro,
					co.tipo AS tipocoro
					
				FROM
					detallecadena dc
					INNER JOIN cadena c ON dc.idcadena = c.idcadena
					INNER JOIN coro co ON dc.idcoro = co.idcoro
					
					
					WHERE c.idcadena = $idcadena
					GROUP BY co.nombre
					ORDER BY dc.num";
			$request = $this->select_all($sql);
			return $request;
		}
	
	}
 ?>