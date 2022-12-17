<?php 

	class Cadenasweb extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function CadenasAvweb()
		{
			$data['page_tag'] = "Cadenas de Coros de Avivamiento";
			$data['page_title'] = "Cadenas de Coros de Avivamiento <small>IEPP</small>";
			$data['page_name'] = "cadenasavweb";
			$data['page_functions_js'] = "functions_cadenasAvweb.js";
			$this->views->getView($this,"cadenasAvweb",$data);
		}

		public function CadenasAdweb()
		{
			$data['page_tag'] = "Cadenas de Coros de Adoración";
			$data['page_title'] = "Cadenas de Coros de Adoración <small>IEPP</small>";
			$data['page_name'] = "cadenasadweb";
			$data['page_functions_js'] = "functions_cadenasAdweb.js";
			$this->views->getView($this,"cadenasAdweb",$data);
		}

		public function getCadenasAv()
		{
				$arrData = $this->model->selectCadenasAv();

				for ($i=0; $i < count($arrData); $i++) {
					$arrNombreCoros = $this->model->selectDetalleNombreCoroCadena($arrData[$i]['idcadena']);
					$strNombreCoros = "";
					for ($j=0; $j < count($arrNombreCoros); $j++) { 
						$strNombreCoros .= "<div>".$arrNombreCoros[$j]['nombrecoro']."</div>";
					}
					$link = "<a class='btn-block genric-btn default' href='".base_url()."/Cadenasweb/CadenaAv/".$arrData[$i]['idcadena']."'><b>".$arrData[$i]['nombre']."</b>".$strNombreCoros."</a>";
					$arrData[$i]['link'] = $link;
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function getCadenasAd()
		{
				$arrData = $this->model->selectCadenasAd();

				for ($i=0; $i < count($arrData); $i++) {
					$arrNombreCoros = $this->model->selectDetalleNombreCoroCadena($arrData[$i]['idcadena']);
					$strNombreCoros = "";
					for ($j=0; $j < count($arrNombreCoros); $j++) { 
						$strNombreCoros .= "<div>".$arrNombreCoros[$j]['nombrecoro']."</div>";
					}
					$link = "<a class='btn-block genric-btn default' href='".base_url()."/Cadenasweb/CadenaAd/".$arrData[$i]['idcadena']."'><b>".$arrData[$i]['nombre']."</b>".$strNombreCoros."</a>";
					$arrData[$i]['link'] = $link;
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function CadenaAv($idcadena)
		{
			$idCadena = $idcadena;
			$arrData = $this->model->selectCadena($idCadena);
			$data['page_tag'] = $arrData[0]['nombrecadena'];
			$data['page_title'] = $arrData[0]['nombrecadena'];
			$data['page_name'] = $arrData[0]['nombrecadena'];
			$data['nombre'] = $arrData[0]['nombrecadena'];
			$strCadenaCoros = "";
			foreach($arrData as $key => $val) {
				$strCadenaCoros .= "<div><b>".$val["nombrecoro"]."</b></div><div>".$val["coro"]."</div><div>&nbsp;</div>";
			}
			$data['cadena'] = "<div class='text-center'>".$strCadenaCoros."</div>";

			$this->views->getView($this,"cadAvweb",$data);
		}
		public function CadenaAd($idcadena)
		{
			$idCadena = $idcadena;
			$arrData = $this->model->selectCadena($idCadena);
			$data['page_tag'] = $arrData[0]['nombrecadena'];
			$data['page_title'] = $arrData[0]['nombrecadena'];
			$data['page_name'] = $arrData[0]['nombrecadena'];
			$data['nombre'] = $arrData[0]['nombrecadena'];
			$strCadenaCoros = "";
			foreach($arrData as $key => $val) {
				$strCadenaCoros .= "<div><b>".$val["nombrecoro"]."</b></div><div>".$val["coro"]."</div><div>&nbsp;</div>";
			}
			$data['cadena'] = "<div class='text-center'>".$strCadenaCoros."</div>";

			$this->views->getView($this,"cadAdweb",$data);
		}
	}
 ?>