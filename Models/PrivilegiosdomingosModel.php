<?php 

	class PrivilegiosdomingosModel extends Mysql
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
	
	

		public function insertPrivilegiosD(string $diasemana, int $dia, int $mes, int $anio, int $turno,  string $inicio, string $alabanzas, string $corosav, string $ofrenda, string $alabanzaespecial, string $corosad, string $mensaje, int $aseo, int $flores){

			$return = "";
			$this->strInicio = $inicio;
			$this->strAlabanza = $alabanzas;
			$this->strCorosav = $corosav;
			$this->strOfrenda = $ofrenda;
			$this->strAlabanzaespecial = $alabanzaespecial;
			$this->strCorosad = $corosad;
			$this->strMensaje = $mensaje;
			
	

			$sql = "SELECT * FROM privilegiosgeneral WHERE dia = $dia 	AND mes = $mes AND anio = $anio AND turno = $turno";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO privilegiosgeneral(diasemana, dia, mes, anio, turno, inicio, alabanzas, avivamiento, ofrenda, alabanzaespecial, adoracion, mensaje, aseo, flores) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($diasemana, $dia, $mes, $anio, $turno, $this->strInicio, $this->strAlabanza, $this->strCorosav, $this->strOfrenda, $this->strAlabanzaespecial,$this->strCorosad,$this->strMensaje, $aseo, $flores);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		
	

		public function updatePrivilegiosD(int $id, string $diasemana, int $dia, int $mes, int $anio, int $turno, string $inicio, string $alabanzas, string $corosav, string $ofrenda,  string $alabanzaespecial, string $corosad, string $mensaje, int $aseo, int $flores){
			$this->intId = $id;
			$this->strInicio = $inicio;
			$this->strAlabanza = $alabanzas;
			$this->strCorosav = $corosav;
			$this->strOfrenda = $ofrenda;
			$this->strAlabanzaespecial = $alabanzaespecial;
			$this->strCorosad = $corosad;
			$this->strMensaje = $mensaje;
			$this->strAseo = $aseo;

			$sql = "SELECT * FROM privilegiosgeneral WHERE dia = $dia 	AND mes = $mes AND anio = $anio AND turno=$turno AND idprivilegio != $this->intId";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE privilegiosgeneral SET  diasemana = ?,  dia = ?,  mes = ?,  anio = ?, turno = ?, inicio = ?, alabanzas = ?, avivamiento = ?, ofrenda = ?,alabanzaespecial = ?,adoracion = ?,mensaje = ?, aseo=?, flores = ? WHERE idprivilegio = $this->intId ";
				$arrData = array($diasemana, $dia, $mes, $anio, $turno, $this->strInicio, $this->strAlabanza, $this->strCorosav, $this->strOfrenda,$this->strAlabanzaespecial,$this->strCorosad,$this->strMensaje,$aseo, $flores);
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
		
	
		public function activarPrivilegiosD(int $id, int $turno){
			$this->intId = $id;

			$sql = "UPDATE privilegiosgeneral SET  estado = ? WHERE turno = $turno";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);

				$sql = "UPDATE privilegiosgeneral SET  estado = ? WHERE idprivilegio = $this->intId AND turno = $turno ";
				$arrData = array(1);
	        	$request = $this->update($sql,$arrData);

		    return $request;			
		}
		public function deletePrivilegiosD(int $intId)
		{
			$this->intId = $intId;
			$sql = "DELETE FROM privilegiosgeneral WHERE idprivilegio = $this->intId ";
			$request = $this->delete($sql);
			return $request;
		}
		
	}
 ?>