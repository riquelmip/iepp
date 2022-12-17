<?php 

	class Privilegiosdomingos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(8);
		}

		public function Privilegiosdomingos ()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}

			$id = $_SESSION['idUser'];
			$arrData = $this->model->selectUsuario($id);
			$data['page_tag'] = "Privilegios Culto Dominical";
			$data['page_title'] = "Privilegios Culto Dominical <small>IEPP</small>";
			$data['page_name'] = "privilegiosd";
			$data['page_iduser'] = $id;
			$data['page_datosuser'] = $arrData;
			$data['page_functions_js'] = "functions_privilegiosdomingos.js";
			$this->views->getView($this,"privilegiosdomingos",$data);
		}

		


		public function getPrivilegiosD()
		{
			
			if ($_SESSION['permisosMod']['r']) {
				
					$arrData = $this->model->selectPrivilegiosDomingos();
				
				
				

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";
					
					$arrData[$i]['turno2'] = "";
					if($arrData[$i]['turno'] == 1)
					{
						$arrData[$i]['turno2'] = 	$arrData[$i]['turno'];
						$arrData[$i]['turno'] = '<span class="badge badge-success">Mañana</span>';
						
					}else{
						$arrData[$i]['turno2'] = 	$arrData[$i]['turno'];
						$arrData[$i]['turno'] = '<span class="badge badge-primary">Tarde</span>';
						
					}
					
					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<div class="text-center"><button class="btn btn-success btn-sm btnAPrivilegios" onClick="fntActivarPrivilegiosD('.$arrData[$i]['idprivilegio'].', '.$arrData[$i]['turno2'].')"><i class="far fa-eye"></i> Activo</button></div>';
					}else{
						$arrData[$i]['estado'] = '<div class="text-center"><button class="btn btn-danger btn-sm btnAPrivilegios" onClick="fntActivarPrivilegiosD('.$arrData[$i]['idprivilegio'].', '.$arrData[$i]['turno2'].')"><i class="far fa-eye"></i> Inactivo</button></div>';
					}
								
			
					

					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewPrivilegios" onClick="fntViewPrivilegios('.$arrData[$i]['idprivilegio'].')" title="Ver Privilegios"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditPrivilegios" onClick="fntEditPrivilegios(this,'.$arrData[$i]['idprivilegio'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelPrivilegios" onClick="fntDelPrivilegios('.$arrData[$i]['idprivilegio'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['fecha'] = $arrData[$i]['dia'].' de '.getMesString(intval($arrData[$i]['mes'])).' de ' .$arrData[$i]['anio'];
					//$arrDataUser = $this->model->selectRol($arrData[$i]['idrol']);
					//$arrData[$i]['usuario'] = $arrDataUser["nombrerol"];
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

					
				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setPrivilegiosD(){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['listDiaS']) ||  empty($_POST['txtFecha']) ||  empty($_POST['listTurno']) || empty($_POST['txtInicio']) || empty($_POST['txtAlabanzas']) || empty($_POST['txtCorosav']) || empty($_POST['txtOfrenda']) || empty($_POST['txtAlabanzaespecial']) || empty($_POST['txtCorosad']) || empty($_POST['txtMensaje']) ||  empty($_POST['listGAseo']) ||  empty($_POST['listGFlores']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					
					$diasemana = $_POST['listDiaS'];
					$strfecha = $_POST['txtFecha'];
					$intId = intval($_POST['idPrivilegios']);
					$turno = $_POST['listTurno'];
					$strInicio =  strClean($_POST['txtInicio']);
					$strAlabanzas = strClean($_POST['txtAlabanzas']);
					$strCorosav = strClean($_POST['txtCorosav']);
					$strOfrenda = strClean($_POST['txtOfrenda']);
					$strAlabanzaespecial = strClean($_POST['txtAlabanzaespecial']);
					$strCorosad = strClean($_POST['txtCorosad']);
					$strMensaje = strClean($_POST['txtMensaje']);
					$strAseo = $_POST['listGAseo'];
					$strFlores = $_POST['listGFlores'];

					//$fecha = date($strfecha);
					$dia = getDiaFecha($strfecha);
					$mes = getMesFecha($strfecha);
					$anio = getAnioFecha($strfecha);
					$diaString = getDiaString($dia);
					

					if($intId == 0)//es crear alabanza
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "alabanza: ".$strAlabanza;
						$request_rol = $this->model->insertPrivilegiosD(
																		$diaString,
																		$dia,
																		$mes,
																		$anio,
																		$turno,
																		$strInicio,
																		$strAlabanzas,
																	 	$strCorosav,
																		$strOfrenda,
																		$strAlabanzaespecial,
																		$strCorosad,
																		$strMensaje,
																		$strAseo,
																	$strFlores);
						}
					}else{ //actualizar alabanza
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updatePrivilegiosD($intId,
																		$diaString,
																		$dia,
																		$mes,
																		$anio,
																		$turno,
																		$strInicio,
																		$strAlabanzas,
																		$strCorosav,
																		$strOfrenda,
																		$strAlabanzaespecial,
																		$strCorosad,
																		$strMensaje,
																		$strAseo,
																		$strFlores);
						}
					}

					if($request_rol > 0 )
					{
						if($option == 1)
						{
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_rol == 'exist'){
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! Los Privilegios ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}



		public function getGrupo($idgrupo){
			if ($_SESSION['permisosMod']['r']) {
				$idGrupo = intval($idgrupo);
				if($idGrupo > 0)
				{
					$arrData = $this->model->selectGrupo($idGrupo);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function getPrivilegio($id){
			if ($_SESSION['permisosMod']['r']) {
				$idPrivilegio = intval($id);
				if($id > 0)
				{
					$arrData = $this->model->selectPrivilegio($id);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}


		public function getPrivilegioD($id){
			if ($_SESSION['permisosMod']['r']) {
				$idPrivilegio = intval($id);
				if($id > 0)
				{
					$arrData = $this->model->selectPrivilegioD($idPrivilegio);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		public function getVerPrivilegioD($id){
			if ($_SESSION['permisosMod']['r']) {
				$idPrivilegio = intval($id);
				if($id > 0)
				{
					$arrData = $this->model->selectVerPrivilegioD($idPrivilegio);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function getDatosUser($id){
			if ($_SESSION['permisosMod']['r']) {
				$idusuario = intval($id);
				if($id > 0)
				{
					$arrData = $this->model->selectUsuario($id);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

	

		public function getSelects()
		{
			$htmlFlores = "";
			$arrDataFlores = $this->model->selectGruposFlores();
			if(count($arrDataFlores) > 0 ){
				for ($i=0; $i < count($arrDataFlores); $i++) { 
				
					$htmlFlores .= '<option value="'.$arrDataFlores[$i]['id'].'">'.$arrDataFlores[$i]['grupo'].'</option>';
					
				}
			}

			$htmlAseo = "";
			$arrDataAseo = $this->model->selectGruposAseo();
			if(count($arrDataAseo) > 0 ){
				for ($i=0; $i < count($arrDataAseo); $i++) { 
				
					$htmlAseo .= '<option value="'.$arrDataAseo[$i]['id'].'">'.$arrDataAseo[$i]['grupo'].'</option>';
					
				}
			}
			$arrResponse1 = array('flores' => $htmlFlores, 'aseo' => $htmlAseo);
			echo json_encode($arrResponse1,JSON_UNESCAPED_UNICODE);
			die();		
		}

	
		public function getSelectRol($id)
		{
			$idR = intval($id);
			$arrData = $this->model->selectRol($idR);
					
			$htmlOptions = '<option value="'.$arrData['idrol'].'">'.$arrData['nombrerol'].'</option>';
					
				
			
			echo $htmlOptions;
			die();		
		}

	


		public function activarPrivilegioD($turno)
		{
			if($_POST){
				if ($_SESSION['permisosMod']['w']) {
					$intId = intval($_POST['idPrivilegio']);
					$turno = intval($turno);
					$requestDelete = $this->model->activarPrivilegiosD($intId, $turno);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha Activado los Privilegios');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al activar los Privilegios.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function delPrivilegioD()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intId = intval($_POST['idPrivilegio']);
					$requestDelete = $this->model->deletePrivilegiosD($intId);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado los Privilegios');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar los Privilegios.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		
	}
 ?>