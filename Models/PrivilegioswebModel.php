<?php 

	class PrivilegioswebModel extends Mysql
	{
	

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectPrivilegiosSabado()
		{
			$sql = "SELECT * FROM privilegios WHERE idrol = 3 AND estado = 1";
					$request = $this->select($sql);
					return $request;
		}
		
		public function selectPrivilegiosMartes()
		{
			$sql = "SELECT * FROM privilegios WHERE idrol = 4 AND estado = 1";
					$request = $this->select($sql);
					return $request;
		}
		public function selectPrivilegiosJueves()
		{
			$sql = "SELECT * FROM privilegios WHERE idrol = 5 AND estado = 1";
					$request = $this->select($sql);
					return $request;
		}

		public function selectVerPrivilegioDM(){
			$sql = "SELECT
			p.diasemana,
			FORMAT( CONCAT( anio, '-', mes, '-', dia ), '%Y-%m-%d' ) AS fechadate,
			p.dia,
			p.mes,
			p.anio,
			p.turno,
			p.inicio,
			p.alabanzas,
			p.avivamiento,
			p.ofrenda,
			p.alabanzaespecial,
			p.adoracion,
			p.mensaje,
			p.aseo,
			p.flores,
			f.grupo AS ngrupoflores,
			f.integrantes AS grupoflores,
			g.grupo AS ngrupoaseo,
			g.integrantes AS grupoaseo 
		FROM
			privilegiosgeneral p
			INNER JOIN gruposaseoflores g ON g.id = p.aseo
			INNER JOIN gruposaseoflores f ON f.id = p.flores 
		WHERE
			p.turno =1 AND p.estado = 1";
					
									
									   
			$request = $this->select($sql);
			return $request;
		}
		public function selectVerPrivilegioDT(){
			$sql = "SELECT
			p.diasemana,
			FORMAT( CONCAT( anio, '-', mes, '-', dia ), '%Y-%m-%d' ) AS fechadate,
			p.dia,
			p.mes,
			p.anio,
			p.turno,
			p.inicio,
			p.alabanzas,
			p.avivamiento,
			p.ofrenda,
			p.alabanzaespecial,
			p.adoracion,
			p.mensaje,
			p.aseo,
			p.flores,
			f.grupo AS ngrupoflores,
			f.integrantes AS grupoflores,
			g.grupo AS ngrupoaseo,
			g.integrantes AS grupoaseo 
		FROM
			privilegiosgeneral p
			INNER JOIN gruposaseoflores g ON g.id = p.aseo
			INNER JOIN gruposaseoflores f ON f.id = p.flores 
		WHERE
			p.turno =2 AND p.estado = 1";
					
									
									   
			$request = $this->select($sql);
			return $request;
		}
	
	
	}
 ?>