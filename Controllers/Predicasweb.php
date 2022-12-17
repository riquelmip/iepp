<?php 

	class Predicasweb extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Predicasweb()
		{
			$data['page_tag'] = "Predicas Cristianas";
			$data['page_title'] = "Predicas Cristianas <small>IEPP</small>";
			$data['page_name'] = "predicasweb";
			$data['page_functions_js'] = "functions_predicasweb.js";
			$this->views->getView($this,"predicasweb",$data);
		}

		public function getPredicas()
		{
				$arrData = $this->model->selectPredicas();

				for ($i=0; $i < count($arrData); $i++) {
					$link = "<a class='btn-block genric-btn default' href='".base_url()."/Predicasweb/Predica/".$arrData[$i]['id']."'>".$arrData[$i]['nombre']."</a>";
					$arrData[$i]['link'] = $link;
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function Predica($idpredica)
		{
			$idPredica = $idpredica;
			$arrData = $this->model->selectPredica($idPredica);
			$data['page_tag'] = $arrData['nombre'];
			$data['page_title'] = $arrData['nombre'];
			$data['page_name'] = $arrData['nombre'];
			$data['nombre'] = $arrData['nombre'];
			$data['predica'] = $arrData['predica'];
			$this->views->getView($this,"predica",$data);
		}

		public function getPredica($idpredica)
		{
				$arrData = $this->model->selectPredica($idpredica);

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
	}
 ?>