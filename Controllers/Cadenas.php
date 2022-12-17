<?php 

	class Cadenas extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true); //para seguridad de sesiones, el id anterior se eliminara y creara uno nuevo
			if (empty($_SESSION['login'])) {
				header('location: '.base_url().'/login');
			}
			getPermisos(5);
		}

		public function CadenasAv()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Cadenas de Coros de Avivamiento";
			$data['page_title'] = "Cadenas de Coros de Avivamiento <small>IEPP</small>";
			$data['page_name'] = "cadenasAv";
			$data['page_functions_js'] = "functions_cadenasAv.js";
			$this->views->getView($this,"cadenasAv",$data);
		}

		public function NuevaCadAv()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Nueva Cadena de Coros de Avivamiento";
			$data['page_title'] = "Nueva Cadena de Coros de Avivamiento <small>IEPP</small>";
			$data['page_name'] = "newcadenasAv";
			$data['page_functions_js'] = "functions_nuevacadenaAv.js";
			$this->views->getView($this,"nuevacadenaAv",$data);
		}
		public function EditarCadAv($idcad)
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Editar Cadena de Coros de Avivamiento";
			$data['page_title'] = "Editar Cadena de Coros de Avivamiento <small>IEPP</small>";
			$data['page_name'] = "editcadenasAv";
			$data['page_idcadena'] = intval($idcad);
			$data['page_functions_js'] = "functions_editarcadenaAv.js";
			$this->views->getView($this,"editarcadenaAv",$data);
		}

		public function CadenasAd()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Cadenas de Coros de Adoración";
			$data['page_title'] = "Cadenas de Coros de Adoración <small>IEPP</small>";
			$data['page_name'] = "cadenasAd";
			$data['page_functions_js'] = "functions_cadenasAd.js";
			$this->views->getView($this,"cadenasAd",$data);
		}
		public function NuevaCadAd()
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Nueva Cadena de Coros de Adoración";
			$data['page_title'] = "Nueva Cadena de Coros de Adoración <small>IEPP</small>";
			$data['page_name'] = "newcadenasAd";
			$data['page_functions_js'] = "functions_nuevacadenaAd.js";
			$this->views->getView($this,"nuevacadenaAd",$data);
		}
		public function EditarCadAd($idcad)
		{
			if (empty($_SESSION['permisosMod']['r'])) {
				header('location: '.base_url().'/dashboard');
			}
			$data['page_tag'] = "Editar Cadena de Coros de Adoración";
			$data['page_title'] = "Editar Cadena de Coros de Adoración <small>IEPP</small>";
			$data['page_name'] = "editcadenasAd";
			$data['page_idcadena'] = intval($idcad);
			$data['page_functions_js'] = "functions_editarcadenaAd.js";
			$this->views->getView($this,"editarcadenaAd",$data);
		}

		public function getCadenasAv()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectCadenasAv();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewCadenaAv" onClick="fntViewCadenaAv('.$arrData[$i]['idcadena'].')" title="Ver Cadena"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCadenaAv" onClick="fntEditCadenaAv('.$arrData[$i]['idcadena'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCadenaAv" onClick="fntDelCadenaAv('.$arrData[$i]['idcadena'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' ' .$btnDelete.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCorosAv()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectCorosAv();

				for ($i=0; $i < count($arrData); $i++) {
					$btnAdd = "";
						

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAv" onClick="fntAddCoroAv('.$arrData[$i]['idcoro'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
					}
				
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnAdd.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
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

		public function getCadenasAd()
		{
			if ($_SESSION['permisosMod']['r']) {
				$arrData = $this->model->selectCadenasAd();

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = "";
					$btnEdit = "";
					$btnDelete = "";			
			
					//si tiene permiso de leer se agrega el boton
					if ($_SESSION['permisosMod']['r']) {
						$btnView = '<button class="btn btn-info btn-sm btnViewCadenaAd" onClick="fntViewCadenaAd('.$arrData[$i]['idcadena'].')" title="Ver Cadena"><i class="far fa-eye"></i></button>';
					}

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditCadenaAd" onClick="fntEditCadenaAd('.$arrData[$i]['idcadena'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}
					//si tiene permiso de eliminar se agrega el boton
					if ($_SESSION['permisosMod']['d']) {
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelCadenaAd" onClick="fntDelCadenaAd('.$arrData[$i]['idcadena'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
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
					$btnAdd = "";
						

					//si tiene permiso de editar se agrega el botn
					if ($_SESSION['permisosMod']['u']) {
						$btnAdd = '<button class="btn btn-primary btn-sm btnAddCoroAd" onClick="fntAddCoroAd('.$arrData[$i]['idcoro'].')" title="Agregar"><i class="fas fa-plus"></i></button>';
					}
				
					//agregamos los botones
					$arrData[$i]['options'] = '<div class="text-center">'.$btnAdd.'</div>';

				
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setCadenaAv($estado){
			//dep($_POST);
			//die();

			if($_POST){
				if(empty($_POST['txtNombre']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdCadena = intval($_POST['idCadena']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strArrayCoros = json_decode($_POST["listaCoros"], true);

					//insertamos la cadena
						if ($_SESSION['permisosMod']['w']) {
						$request_rol = $this->model->insertCadena($strNombre, 1);
						}
					//obtenemos el id de la cadena que se inserto
						$arrUltimaCad = $this->model->selectUltimaCadenaIngresada();
						
					if($request_rol > 0 )
					{
						foreach ($strArrayCoros as $key => $value) {

							//insertamos los detalles
							$item = "id";
							$valor = $value["id"];
							$coro = $value["coro"];
			
							if ($_SESSION['permisosMod']['w']) {
								$request_rol1 = $this->model->insertDetalleCadena($valor, $arrUltimaCad["idcadena"], $key+1);
								}
							
						}
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					
					}else if($request_rol == 'exist'){
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La Cadena ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
			
		}

		public function editCadenaAv($estado){
			//dep($_POST);
			//die();

			if($_POST){
				if(empty($_POST['txtNombre']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdCadena = intval($_POST['idCadena']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strArrayCoros = json_decode($_POST["listaCoros"], true);

					//insertamos la cadena
						if ($_SESSION['permisosMod']['w']) {
						$request_rol = $this->model->editCadena($intIdCadena, $strNombre, 1);
						$request_rol1 = $this->model->deleteDetallesCadena($intIdCadena);
						}

						
					if($request_rol > 0 )
					{
						foreach ($strArrayCoros as $key => $value) {

							//insertamos los detalles
							$item = "id";
							$valor = $value["id"];
							$coro = $value["coro"];
			
							if ($_SESSION['permisosMod']['w']) {
								$request_rol1 = $this->model->insertDetalleCadena($valor, $intIdCadena , $key+1);
								}
							
						}
							$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
					
					}else if($request_rol == 'exist'){
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La Cadena ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
			
		}
		public function setCadenaAd($estado){
			//dep($_POST);
			//die();

			if($_POST){
				if(empty($_POST['txtNombre']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdCadena = intval($_POST['idCadena']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strArrayCoros = json_decode($_POST["listaCoros"], true);

					//insertamos la cadena
						if ($_SESSION['permisosMod']['w']) {
						$request_rol = $this->model->insertCadena($strNombre, 1);
						}
					//obtenemos el id de la cadena que se inserto
						$arrUltimaCad = $this->model->selectUltimaCadenaIngresada();
						
					if($request_rol > 0 )
					{
						foreach ($strArrayCoros as $key => $value) {

							//insertamos los detalles
							$item = "id";
							$valor = $value["id"];
							$coro = $value["coro"];
			
							if ($_SESSION['permisosMod']['w']) {
								$request_rol1 = $this->model->insertDetalleCadena($valor, $arrUltimaCad["idcadena"], $key+1);
								}
							
						}
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					
					}else if($request_rol == 'exist'){
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La Cadena ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
			
		}

		public function editCadenaAd($estado){
			//dep($_POST);
			//die();

			if($_POST){
				if(empty($_POST['txtNombre']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$intIdCadena = intval($_POST['idCadena']);
					$strNombre =  strClean($_POST['txtNombre']);
					$strArrayCoros = json_decode($_POST["listaCoros"], true);

					//insertamos la cadena
						if ($_SESSION['permisosMod']['w']) {
						$request_rol = $this->model->editCadena($intIdCadena, $strNombre, 2);
						$request_rol1 = $this->model->deleteDetallesCadena($intIdCadena);
						}

						
					if($request_rol > 0 )
					{
						foreach ($strArrayCoros as $key => $value) {

							//insertamos los detalles
							$item = "id";
							$valor = $value["id"];
							$coro = $value["coro"];
			
							if ($_SESSION['permisosMod']['w']) {
								$request_rol1 = $this->model->insertDetalleCadena($valor, $intIdCadena , $key+1);
								}
							
						}
							$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
					
					}else if($request_rol == 'exist'){
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La Cadena ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				
			}
			die();
			
		}
		public function getCadena($idcadena){
			if ($_SESSION['permisosMod']['r']) {
				$idCadena = intval($idcadena);
				if($idCadena > 0)
				{
					$arrData = $this->model->selectCadena($idCadena);
					
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

		public function getDetallesCadena($idcadena){
			if ($_SESSION['permisosMod']['r']) {
				$idCadena = intval($idcadena);
				if($idCadena > 0)
				{
					$arrData = $this->model->selectDetallesCadena($idCadena);
					
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
		public function getOnlyCadena($idcadena){
			if ($_SESSION['permisosMod']['r']) {
				$idCadena = intval($idcadena);
				if($idCadena > 0)
				{
					$arrData = $this->model->selectOnlyCadena($idCadena);
					
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

		public function delCadena()
		{
			if($_POST){
				if ($_SESSION['permisosMod']['d']) {
					$intIdCadena = intval($_POST['idCadena']);
					$requestDeleteDetalles = $this->model->deleteDetallesCadena($intIdCadena);
					$requestDelete = $this->model->deleteCadena($intIdCadena);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la Cadena');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la Cadena.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		
	}
 ?>