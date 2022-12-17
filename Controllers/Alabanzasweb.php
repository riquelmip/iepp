<?php 

	class Alabanzasweb extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Alabanzasweb()
		{
			$data['page_tag'] = "Cancionero de Alabanzas";
			$data['page_title'] = "Cancionero de Alabanzas <small>IEPP</small>";
			$data['page_name'] = "cancioneroweb";
			$data['page_functions_js'] = "functions_cancioneroweb.js";
			$this->views->getView($this,"cancioneroweb",$data);
		}

		public function getCancionero()
		{
				$arrData = $this->model->selectCancionero();

				for ($i=0; $i < count($arrData); $i++) {
					$link = "<a class='btn-block genric-btn default' href='".base_url()."/Alabanzasweb/alabanzaC/".$arrData[$i]['id']."'>".$arrData[$i]['nombre']."</a>";
					$arrData[$i]['link'] = $link;
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function alabanzaC($idalabanza)
		{
			$idAlabanza = $idalabanza;
			$arrData = $this->model->selectAlabanza($idAlabanza);
			$data['page_tag'] = $arrData['nombre'];
			$data['page_title'] = $arrData['nombre'];
			$data['page_name'] = $arrData['nombre'];
			$data['nombre'] = $arrData['nombre'];
			$data['alabanza'] = $arrData['alabanza'];
			$this->views->getView($this,"alabanzaC",$data);
		}
	}
 ?>