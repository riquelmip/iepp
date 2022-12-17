<?php 

	class Coros extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(10);
		}

		public function CorosAv()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Coros de Avivamiento";
			$data['page_title'] = "Coros de Avivamiento <small>IEPP</small>";
			$data['page_name'] = "corosAv";
			$data['page_functions_js'] = "functions_corosAv.js";
			$this->views->getView($this,"corosAv",$data);
		}
		public function CorosAd()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Coros de Adoración";
			$data['page_title'] = "Coros de Adoración <small>IEPP</small>";
			$data['page_name'] = "corosAd";
			$data['page_functions_js'] = "functions_corosAd.js";
			$this->views->getView($this,"corosAd",$data);
		}
		

		public function getCorosAv()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectCorosAv();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewCoroAv" onClick="fntViewCoroAv('.$arrData[$i]['idcoro'].')" title="Ver Coro"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCoroAv" onClick="fntEditCoroAv(this,'.$arrData[$i]['idcoro'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCoroAv" onClick="fntDelCoroAv('.$arrData[$i]['idcoro'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCorosAd()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectCorosAd();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewCoroAv" onClick="fntViewCoroAd('.$arrData[$i]['idcoro'].')" title="Ver Coro"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCoroAv" onClick="fntEditCoroAd(this,'.$arrData[$i]['idcoro'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCoroAv" onClick="fntDelCoroAd('.$arrData[$i]['idcoro'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setCoroAv($tipo){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtNombre']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdCoro = intval($_POST['idCoro']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strCoro = strClean($_POST['txtCoro']);

					if($intIdCoro == 0)//es crear coro
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "alabanza: ".$strAlabanza;
						$request_rol = $this->model->insertCoro($strNombre, $strCoro, 1);
						}
					}else{ //actualizar alabanza
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updateCoro($intIdCoro,$strNombre, $strCoro, 1);
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
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! El coro ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function setCoroAd($tipo){
			//dep($_POST);
			//die();
			if($_POST){
				if(empty($_POST['txtNombre']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdCoro = intval($_POST['idCoro']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strCoro = strClean($_POST['txtCoroAd']);

					if($intIdCoro == 0)//es crear coro
					{
						$option = 1;
						if ($_SESSION['permisosMod']['w']) {
						//Crear
						//echo "alabanza: ".$strAlabanza;
						$request_rol = $this->model->insertCoro($strNombre, $strCoro, 2);
						}
					}else{ //actualizar alabanza
						$option = 2;
						if ($_SESSION['permisosMod']['u']) {
						//Actualizar
						$request_rol = $this->model->updateCoro($intIdCoro,$strNombre, $strCoro, 2);
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
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! El coro ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCoro($idcoro){
			if ($_SESSION['permisosMod']['r']) {
				$idCoro = intval($idcoro);
				if($idCoro > 0)
				{
					$arrData = $this->model->selectCoro($idCoro);
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

		public function delCoro()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intIdCoro = intval($_POST['idCoro']);
					$requestDelete = $this->model->deleteCoro($intIdCoro);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el coro');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el coro.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		
	}
 ?>