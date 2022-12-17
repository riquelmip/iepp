<?php 

	class Predicas extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(9);
		}

		public function Predicas()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Predicas Cristianas";
			$data['page_title'] = "Predicas Cristianas <small>IEPP</small>";
			$data['page_name'] = "predicas";
			$data['page_functions_js'] = "functions_predicas.js";
			$this->views->getView($this,"predicas",$data);
		}

		public function getPredicas()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectPredicas();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewPredicas" onClick="fntViewPredicas('.$arrData[$i]['id'].')" title="Ver Predica"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditPredicas" onClick="fntEditPredicas(this,'.$arrData[$i]['id'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelPredicas" onClick="fntDelPredicas('.$arrData[$i]['id'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setPredicas(){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtNombre']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdPredica = intval($_POST['idPredica']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strPredica = strClean($_POST['txtPredica']);

					if($intIdPredica == 0)//es crear Predica
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "Predica: ".$strPredica;
						$request_rol = $this->model->insertPredica($strNombre, $strPredica);
						}
					}else{ //actualizar Predica
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updatePredica($intIdPredica, $strNombre, $strPredica);
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
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La Predica ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getPredica($idPredica){
			if ($_SESSION['permisosMod']['r']) {
				$idPredica = intval($idPredica);
				if($idPredica > 0)
				{
					$arrData = $this->model->selectPredica($idPredica);
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

		public function delPredica()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intIdPredica = intval($_POST['idPredica']);
					$requestDelete = $this->model->deletePredica($intIdPredica);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Predica');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Predica.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		
	}
 ?>