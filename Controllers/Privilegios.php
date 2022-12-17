<?php 

	class Privilegios extends Controllers{
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

		public function Privilegios()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}

			$id = $_SESSION['idUser'];
			$arrData = $this->model->selectUsuario($id);
			$data['page_tag'] = "Privilegios Cultos ".$arrData["nombrerol"];
			$data['page_title'] = "Privilegios Cultos ".$arrData["nombrerol"]." <small>IEPP</small>";
			$data['page_name'] = "privilegios";
			$data['page_iduser'] = $id;
			$data['page_datosuser'] = $arrData;
			$data['page_functions_js'] = "functions_privilegios.js";
			$this->views->getView($this,"privilegios",$data);
		}

	
		public function GruposAseo()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}


			$data['page_tag'] = "Grupos de Aseo";
			$data['page_title'] = "Grupos de Aseo <small>IEPP</small>";
			$data['page_name'] = "gruposaseo";
			$data['page_functions_js'] = "functions_gruposeyf.js";
			$this->views->getView($this,"gruposaseo",$data);
		}
		public function GruposFlores()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}


			$data['page_tag'] = "Grupos de Flores";
			$data['page_title'] = "Grupos de Flores <small>IEPP</small>";
			$data['page_name'] = "gruposflores";
			$data['page_functions_js'] = "functions_gruposflores.js";
			$this->views->getView($this,"gruposflores",$data);
		}


		public function getPrivilegios()
		{
			$id = $_SESSION['idUser'];
			$arrDataUser = $this->model->selectUsuario($id);
			
			if ($_SESSION['permisosMod']['r']) {
				if ($id == 1) {
					$arrData = $this->model->selectPrivilegios();
				}else{
					$arrData = $this->model->selectPrivilegiosUser($arrDataUser["idrol"]);
				}
				
				

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<div class="text-center"><button class="btn btn-success btn-sm btnAPrivilegios" onClick="fntActivarPrivilegios('.$arrData[$i]['idprivilegio'].', '.$arrData[$i]['idrol'].')"><i class="far fa-eye"></i> Activo</button></div>';
					}else{
						$arrData[$i]['estado'] = '<div class="text-center"><button class="btn btn-danger btn-sm btnAPrivilegios" onClick="fntActivarPrivilegios('.$arrData[$i]['idprivilegio'].', '.$arrData[$i]['idrol'].')"><i class="far fa-eye"></i> Inactivo</button></div>';
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
					$arrDataUser = $this->model->selectRol($arrData[$i]['idrol']);
					$arrData[$i]['usuario'] = $arrDataUser["nombrerol"];
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		

		public function getGruposAseo()
		{
			
			if ($_SESSION['permisosMod']['r']) {
				
					$arrData = $this->model->selectGruposAseo();
				
				
				

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					

					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnView" onClick="fntView('.$arrData[$i]['id'].')" title="Ver Privilegios"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEdit" onClick="fntEdit(this,'.$arrData[$i]['id'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDel" onClick="fntDel('.$arrData[$i]['id'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
				
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getGruposFlores()
		{
			
			if ($_SESSION['permisosMod']['r']) {
				
					$arrData = $this->model->selectGruposFlores();
				
				
				

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					

					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnView" onClick="fntView('.$arrData[$i]['id'].')" title="Ver Privilegios"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEdit" onClick="fntEdit(this,'.$arrData[$i]['id'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDel" onClick="fntDel('.$arrData[$i]['id'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
				
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setPrivilegios(){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtInicio']) || empty($_POST['txtAlabanzas']) || empty($_POST['txtCorosav']) || empty($_POST['txtPresentacion']) || empty($_POST['txtOfrenda']) || empty($_POST['txtTalento']) || empty($_POST['txtAlabanzaespecial']) || empty($_POST['txtCorosad']) || empty($_POST['txtMensaje']) ||  empty($_POST['txtAseo']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$listrol = $_POST['listRolid'];
					$diasemana = $_POST['listDiaS'];
					$strfecha = $_POST['txtFecha'];
					$intId = intval($_POST['idPrivilegios']);
					$strInicio =  strClean($_POST['txtInicio']);
					$strAlabanzas = strClean($_POST['txtAlabanzas']);
					$strCorosav = strClean($_POST['txtCorosav']);
					$strPresentacion = strClean($_POST['txtPresentacion']);
					$strOfrenda = strClean($_POST['txtOfrenda']);
					$strTalento = strClean($_POST['txtTalento']);
					$strAlabanzaespecial = strClean($_POST['txtAlabanzaespecial']);
					$strCorosad = strClean($_POST['txtCorosad']);
					$strMensaje = strClean($_POST['txtMensaje']);
					$strAseo = strClean($_POST['txtAseo']);

					$fecha = date($strfecha);
					$dia = date("d", strtotime($fecha));
					$mes = date("m", strtotime($fecha));
					$anio = date("Y",strtotime($fecha));
					$strdiasem = "";
					if ($diasemana == 1) {
						$strdiasem = "Domingo";
					}else if ($diasemana == 2) {
						$strdiasem = "Lunes";
					}else if ($diasemana == 3) {
						$strdiasem = "Martes";
					} else if ($diasemana == 4) {
						$strdiasem = "Miércoles";
					} else if ($diasemana == 5) {
						$strdiasem = "Jueves";
					}  else if ($diasemana == 6) {
						$strdiasem = "Viernes";
					} else if ($diasemana == 7) {
						$strdiasem = "Sábado";
					} 
					

					if($intId == 0)//es crear alabanza
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "alabanza: ".$strAlabanza;
						$request_rol = $this->model->insertPrivilegios($listrol,
																		$strdiasem,
																		$dia,
																		$mes,
																		$anio,
																		$strInicio,
																		$strAlabanzas,
																	 	$strCorosav,
																		$strPresentacion,
																		$strOfrenda,
																		$strTalento,
																		$strAlabanzaespecial,
																		$strCorosad,
																		$strMensaje,
																		$strAseo);
						}
					}else{ //actualizar alabanza
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updatePrivilegios($intId,
																		$listrol,
																		$strdiasem,
																		$dia,
																		$mes,
																		$anio,
																		$strInicio,
																		$strAlabanzas,
																		$strCorosav,
																		$strPresentacion,
																		$strOfrenda,
																		$strTalento,
																		$strAlabanzaespecial,
																		$strCorosad,
																		$strMensaje,
																		$strAseo);
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
		
		public function setGrupoAseo(){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtNombre']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdGrupo = intval($_POST['idGrupo']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strIntegrantes = strClean($_POST['txtIntegrantes']);

					if($intIdGrupo == 0)//es crear Predica
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "Predica: ".$strPredica;
						$request_rol = $this->model->insertGrupo($strNombre, $strIntegrantes, 1); //1 es tipo dwe grupo aseo
						}
					}else{ //actualizar Predica
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updateGrupo($intIdGrupo, $strNombre, $strIntegrantes, 1);
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
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! El grupo ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setGrupoFlores(){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtNombre']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdGrupo = intval($_POST['idGrupo']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strIntegrantes = strClean($_POST['txtIntegrantes']);

					if($intIdGrupo == 0)//es crear Predica
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "Predica: ".$strPredica;
						$request_rol = $this->model->insertGrupo($strNombre, $strIntegrantes, 2); //1 es tipo dwe grupo aseo
						}
					}else{ //actualizar Predica
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updateGrupo($intIdGrupo, $strNombre, $strIntegrantes, 2);
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
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! El grupo ya existe.');
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

		public function delPrivilegio()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intId = intval($_POST['idPrivilegio']);
					$requestDelete = $this->model->deletePrivilegios($intId);
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

		public function activarPrivilegio($idrol)
		{
			if($_POST){
				if ($_SESSION['permisosMod']['w']) {
					$intId = intval($_POST['idPrivilegio']);
					$intidrol = intval($idrol);
					$requestDelete = $this->model->activarPrivilegios($intId, $intidrol);
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
	
		public function delGrupo()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intId = intval($_POST['idGrupo']);
					$requestDelete = $this->model->deleteGrupo($intId);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el grupo');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el grupo.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
	}
 ?>