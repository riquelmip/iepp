<?php 

	class Himnario extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(3);
		}

		public function Himnario()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Himnario";
			$data['page_title'] = "Himnario Oficial de Alabanzas <small>IEPP</small>";
			$data['page_name'] = "himnario";
			$data['page_functions_js'] = "functions_himnario.js";
			$this->views->getView($this,"himnario",$data);
		}

		public function getHimnario()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectHimnario();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewHimnario" onClick="fntViewHimnario('.$arrData[$i]['idalabanza'].')" title="Ver Alabanza"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditHimnario" onClick="fntEditHimnario(this,'.$arrData[$i]['idalabanza'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelHimnario" onClick="fntDelHimnario('.$arrData[$i]['idalabanza'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setHimnario(){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtNombre']) || empty($_POST['txtNumhimnario']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdAlabanza = intval($_POST['idAlabanza']);
					$intNumhimnario = intval($_POST['txtNumhimnario']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strAlabanza = strClean($_POST['txtAlabanza']);

					if($intIdAlabanza == 0)//es crear alabanza
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "alabanza: ".$strAlabanza;
						$request_rol = $this->model->insertAlabanza($intNumhimnario, $strNombre, $strAlabanza);
						}
					}else{ //actualizar alabanza
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updateAlabanza($intIdAlabanza, $intNumhimnario, $strNombre, $strAlabanza);
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
					$arrData = $this->model->selectAlabanza($idAlabanza);
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
					$requestDelete = $this->model->deleteAlabanza($intIdAlabanza);
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