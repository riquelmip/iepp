<?php 

	class Himnarioweb extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Himnarioweb()
		{
			$data['page_tag'] = "Himnario Oficial";
			$data['page_title'] = "Himnario Oficial de Alabanzas <small>IEPP</small>";
			$data['page_name'] = "himnarioweb";
			$data['page_functions_js'] = "functions_himnarioweb.js";
			$this->views->getView($this,"himnarioweb",$data);
		}

		public function getHimnario()
		{
				$arrData = $this->model->selectHimnario();

				for ($i=0; $i < count($arrData); $i++) {
					$link = "<a class='btn-block genric-btn default' href='".base_url()."/Himnarioweb/alabanzaH/".$arrData[$i]['idalabanza']."'>".$arrData[$i]['nombre']."</a>";
					$arrData[$i]['link'] = $link;
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function alabanzaH($idalabanza)
		{
			$idAlabanza = $idalabanza;
			$arrData = $this->model->selectAlabanza($idAlabanza);
			$data['page_tag'] = $arrData['nombre'];
			$data['page_title'] = $arrData['nombre'];
			$data['page_name'] = $arrData['nombre'];
			$data['nombre'] = $arrData['nombre'];
			$data['alabanza'] = $arrData['alabanza'];
			$this->views->getView($this,"alabanzaH",$data);
		}
	}
 ?>