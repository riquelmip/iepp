<?php 

	class PrivilegiosModel extends Mysql
	{
		private $intId;
		private $dateFecha;
		private $strInicio;
		private $strAlabanza;
		private $strCorosav;
		private $strPresentacion;
		private $strOfrenda;
		private $strTalento;
		private $strAlabanzaespecial;
		private $strCorosad;
		private $strMensaje;
		private $strAseo;
		private $strNombre;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectPrivilegios()
		{
			$sql = "SELECT * FROM privilegios";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectPrivilegiosDomingos()
		{
			$sql = "SELECT * FROM privilegiosgeneral";
					$request = $this->select_all($sql);
					return $request;
		}
		public function selectGruposAseo()
		{
			$sql = "SELECT * FROM gruposaseoflores WHERE tipogrupo=1";
					$request = $this->select_all($sql);
					return $request;
		}
		
		public function selectGruposFlores()
		{
			$sql = "SELECT * FROM gruposaseoflores WHERE tipogrupo=2";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectPrivilegiosUser(int $id)
		{
			$this->intId = $id;
			$sql = "SELECT * FROM privilegios WHERE idrol=$this->intId";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectPrivilegio(int $id){
			$this->intId = $id;
			$sql = "SELECT * FROM privilegios
					WHERE idprivilegio = $this->intId";
			$request = $this->select($sql);
			return $request;
		}
		public function selectPrivilegioD(int $id){
			$this->intId = $id;
			$sql = "SELECT *, DATE_FORMAT(CONCAT(anio, '-', mes, '-', dia),'%Y-%m-%d') as fechadate
			FROM privilegiosgeneral
					WHERE idprivilegio = $this->intId";
					
									
									   
			$request = $this->select($sql);
			return $request;
		}

		public function selectVerPrivilegioD(int $id){
			$this->intId = $id;
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
			idprivilegio = $this->intId";
					
									
									   
			$request = $this->select($sql);
			return $request;
		}

		public function selectGrupo(int $id){
			$this->intId = $id;
			$sql = "SELECT * FROM gruposaseoflores
					WHERE id = $this->intId";
			$request = $this->select($sql);
			return $request;
		}
	

		public function selectRoles()
		{
			//EXTRAE ROLES
			$sql = "SELECT * FROM rol WHERE status != 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectRol(int $id)
		{
			$this->intId = $id;
			//EXTRAE ROLES
			$sql = "SELECT * FROM rol WHERE idrol = $this->intId AND status != 0";
			$request = $this->select($sql);
			return $request;
		}

		public function selectUsuario(int $id){
			$this->intId = $id;
			$sql = "SELECT 
					p.idpersona,
					p.identificacion,
					p.nombres, 
					p.apellidos,
					p.telefono,
					p.email_user,
					r.idrol,
					r.nombrerol,
					r.descripcion 
					FROM persona p 
					INNER JOIN rol r ON r.idrol = p.rolid
					WHERE p.idpersona=$this->intId";
			$request = $this->select($sql);
			return $request;
		}
	
		public function insertPrivilegios(int $listrol, string $diasemana, int $dia, int $mes, int $anio,  string $inicio, string $alabanzas, string $corosav, string $presen, string $ofrenda, string $talento, string $alabanzaespecial, string $corosad, string $mensaje, string $aseo){

			$return = "";
			$this->strInicio = $inicio;
			$this->strAlabanza = $alabanzas;
			$this->strCorosav = $corosav;
			$this->strPresentacion = $presen;
			$this->strOfrenda = $ofrenda;
			$this->strTalento = $talento;
			$this->strAlabanzaespecial = $alabanzaespecial;
			$this->strCorosad = $corosad;
			$this->strMensaje = $mensaje;
			$this->strAseo = $aseo;
			
	

			$sql = "SELECT * FROM privilegios WHERE dia = $dia 	AND mes = $mes AND anio = $anio AND idrol=$listrol ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO privilegios(idrol, diasemana, dia, mes, anio, inicio, alabanzas, avivamiento,presentacion,ofrenda,talento,alabanzaespecial,adoracion,mensaje,aseo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($listrol, $diasemana, $dia, $mes, $anio, $this->strInicio, $this->strAlabanza, $this->strCorosav, $this->strPresentacion,$this->strOfrenda,$this->strTalento,$this->strAlabanzaespecial,$this->strCorosad,$this->strMensaje,$this->strAseo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

	

		public function insertGrupo(string $nombre, string $integrantes, int $tipogrupo){

			$return = "";
			$this->strNombre = $nombre;
			
	

			$sql = "SELECT * FROM gruposaseoflores WHERE grupo = '$this->strNombre' AND tipogrupo = $tipogrupo";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO gruposaseoflores(grupo, integrantes, tipogrupo) VALUES(?,?,?)";
	        	$arrData = array($nombre, $integrantes, $tipogrupo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updatePrivilegios(int $id, int $listrol, string $diasemana, int $dia, int $mes, int $anio,  string $inicio, string $alabanzas, string $corosav, string $presen, string $ofrenda, string $talento, string $alabanzaespecial, string $corosad, string $mensaje, string $aseo){
			$this->intId = $id;
			$this->strInicio = $inicio;
			$this->strAlabanza = $alabanzas;
			$this->strCorosav = $corosav;
			$this->strPresentacion = $presen;
			$this->strOfrenda = $ofrenda;
			$this->strTalento = $talento;
			$this->strAlabanzaespecial = $alabanzaespecial;
			$this->strCorosad = $corosad;
			$this->strMensaje = $mensaje;
			$this->strAseo = $aseo;

			$sql = "SELECT * FROM privilegios WHERE dia = $dia 	AND mes = $mes AND anio = $anio AND idrol=$listrol AND idprivilegio != $this->intId";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE privilegios SET  diasemana = ?,  dia = ?,  mes = ?,  anio = ?, inicio = ?, alabanzas = ?, avivamiento = ?,presentacion = ?,ofrenda = ?,talento = ?,alabanzaespecial = ?,adoracion = ?,mensaje = ?, aseo=? WHERE idprivilegio = $this->intId ";
				$arrData = array($diasemana, $dia, $mes, $anio, $this->strInicio, $this->strAlabanza, $this->strCorosav, $this->strPresentacion,$this->strOfrenda,$this->strTalento,$this->strAlabanzaespecial,$this->strCorosad,$this->strMensaje,$this->strAseo);
	        	$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

	

		public function updateGrupo(int $id, string $nombre, string $integrantes, int $tipogrupo){
			$this->intId = $id;
		

			$sql = "SELECT * FROM gruposaseoflores WHERE grupo = '$nombre' AND id != $this->intId AND tipogrupo=$tipogrupo";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE gruposaseoflores SET grupo = ?, integrantes=? WHERE id = $this->intId ";
				$arrData = array($nombre, $integrantes);
	        	$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}
		public function deletePrivilegios(int $intId)
		{
			$this->intId = $intId;
			$sql = "DELETE FROM privilegios WHERE idprivilegio = $this->intId ";
			$request = $this->delete($sql);
			return $request;
		}
		public function activarPrivilegios(int $id, int $idrol){
			$this->intId = $id;

			$sql = "UPDATE privilegios SET  estado = ? WHERE idrol = $idrol";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);

				$sql = "UPDATE privilegios SET  estado = ? WHERE idprivilegio = $this->intId AND idrol = $idrol ";
				$arrData = array(1);
	        	$request = $this->update($sql,$arrData);

		    return $request;			
		}
	
		public function deleteGrupo(int $intId)
		{
			$this->intId = $intId;
			$sql = "DELETE FROM gruposaseoflores WHERE id = $this->intId ";
			$request = $this->delete($sql);
			return $request;
		}

	}
 ?>