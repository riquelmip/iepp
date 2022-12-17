<?php 

	class Login extends Controllers{
		public function __construct()
		{
			session_start();
			if (isset($_SESSION['login'])) {
				header('location: '.base_url().'/dashboard');
			}
			parent::__construct();
		}

		public function login()
		{
			$data['page_tag'] = "Login";
			$data['page_title'] = "IEPP Sistema";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "functions_login.js";
			$this->views->getView($this,"login",$data);
		}

		public function loginUser(){
			if ($_POST) {
				if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
					$arrResponse = array('status' => false, 'msg' => 'Error de datos');
				}else{
					$strUsuario = strtolower(strClean($_POST['txtEmail']));
					$strPassword = hash("SHA256", $_POST['txtPassword']);
					$request_user = $this->model->loginUser($strUsuario, $strPassword);
					if (empty($request_user)) {
						$arrResponse = array('status' => false, 'msg' => 'El Usuario y/o Contraseña es incorrecta');
					}else{
						$arrData = $request_user;
						if ($arrData['status'] == 1) {
							$_SESSION['idUser'] = $arrData['idpersona'];
							$_SESSION['idRolUser'] = $arrData['rolid'];
							$_SESSION['login'] = true;

							$arrData = $this->model->sessionLogin($_SESSION['idUser']);
							sessionUser($_SESSION['idUser']); //crea la variable sesion

							$arrResponse = array('status' => true, 'msg' => 'Inicio de Sesión correctamente');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'El Usuario esta Inactivo');
						}
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function resetPass(){
			if ($_POST) {
				//para que aunque no se pueda enviar el email, siempre tire la alrta de que no se pudo
				error_reporting(0);
				if (empty($_POST['txtEmailReset'])) {
					$arrResponse = array('status' => false, 'msg' => 'Error de Datos');
				}else{
					$token = token();
					$strEmail = strtolower(strClean($_POST['txtEmailReset']));
					$arrData = $this->model->getUserEmail($strEmail);

					if (empty($arrData)) {
						$arrResponse = array('status' => false, 'msg' => 'Usuario no encontrado');
					}else{
						$idPersona = $arrData['idpersona'];
						$nombreUsuario = $arrData['nombres'].' '.$arrData['apellidos'];

						$url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;

						$requestUpdate = $this->model->setTokenUser($idPersona, $token);

						//preparando el correo para recuperar la cuenta
						$dataUsuario = array('nombreUsuario' => $nombreUsuario,
											 'email' => $strEmail,
											 'asunto' => 'Recuperar Cuenta - '.NOMBRE_REMITENTE,
											 'url_recovery' => $url_recovery);

						if ($requestUpdate) {
							//enviar el email
							$sendEmail = sendEmail($dataUsuario, 'email_cambioPassword');
							if ($sendEmail) {
								$arrResponse = array('status' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña');
							}else{
								$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
							}
						}else{
							$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intenta mas tarde');
						}
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function confirmUser(string $params){
			if (empty($params)) {
				header('Location: '.base_url());
			}else{
				//obteniendo los parametros
				$arrParams = explode(',', $params);
				$strEmail = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);
				$arrResponse = $this->model->getUsuario($strEmail, $strToken);

				//si no encuentra el registro
				if (empty($arrResponse)) {
					header('Location: '.base_url());
				}else{
					$data['page_tag'] = "Cambiar Contraseña";
					$data['page_title'] = "Cambiar Contraseña";
					$data['page_name'] = "cambiar_contraseña";
					$data['page_functions_js'] = "functions_login.js";
					$data['email'] = $strEmail;
					$data['token'] = $strToken;
					$data['idpersona'] = $arrResponse['idpersona'];
					$this->views->getView($this,"cambiar_password",$data);
				}
			}
			die();
		}

		public function setPassword(){
			if (empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])) {
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			}else{
				$intIdpersona = intval($_POST['idUsuario']);
				$strEmail = strClean($_POST['txtEmail']);
				$strToken = strClean($_POST['txtToken']);
				$strPassword = $_POST['txtPassword'];
				$strPasswordConfirm = $_POST['txtPasswordConfirm'];

				if ($strPassword != $strPasswordConfirm) {
					$arrResponse = array('status' => false, 'msg' => 'Las contraseña no son iguales');
				}else{
					$arrResponseUser = $this->model->getUsuario($strEmail, $strToken);

					//si no encuentra el registro
					if (empty($arrResponseUser)) {
						$arrResponse = array('status' => false, 'msg' => 'Error de datos');
					}else{
						$strPassword = hash("SHA256", $strPassword);
						$requestPass = $this->model->insertPassword($intIdpersona, $strPassword);

						if ($requestPass) {
							$arrResponse = array('status' => true, 'msg' => 'Contraseña actualizada correctamente');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente mas tarde');
						}
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}

	}
 ?>