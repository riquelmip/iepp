<?php 

	class Alabanzas extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(4);
		}

		public function Alabanzas()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Cancionero - Alabanzas";
			$data['page_title'] = "Cancionero de Alabanzas <small>IEPP</small>";
			$data['page_name'] = "alabanzas";
			$data['page_functions_js'] = "functions_alabanzas.js";
			$this->views->getView($this,"alabanzas",$data);
		}

		public function getAlabanzas()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectAlabanzas();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewAlabanzas" onClick="fntViewAlabanzasC('.$arrData[$i]['id'].')" title="Ver Alabanza"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditAlabanzas" onClick="fntEditAlabanzasC(this,'.$arrData[$i]['id'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelAlabanzas" onClick="fntDelAlabanzasC('.$arrData[$i]['id'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setAlabanzas(){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtNombre']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdAlabanza = intval($_POST['idAlabanza']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strAlabanza = strClean($_POST['txtAlabanza']);

					if($intIdAlabanza == 0)//es crear alabanza
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "alabanza: ".$strAlabanza;
						$request_rol = $this->model->insertAlabanzaC($strNombre, $strAlabanza);
						}
					}else{ //actualizar alabanza
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updateAlabanzaC($intIdAlabanza, $strNombre, $strAlabanza);
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
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La alabanza ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getAlabanza($idalabanza){
			if ($_SESSION['permisosMod']['r']) {
				$idAlabanza = intval($idalabanza);
				if($idAlabanza > 0)
				{
					$arrData = $this->model->selectAlabanzaC($idAlabanza);
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

		public function delAlabanza()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intIdAlabanza = intval($_POST['idAlabanza']);
					$requestDelete = $this->model->deleteAlabanzaC($intIdAlabanza);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Alabanza');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Alabanza.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		
	}
 ?>