<?php 

	class Privilegiosweb extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Privilegiosweb()
		{
			$data['page_tag'] = "Privilegios Cultos Sábados";
			$data['page_title'] = "Privilegios Cultos Sábados <small>IEPP</small>";
			$data['page_name'] = "privilegiosweb";
			$dataDomingoM = $this->model->selectVerPrivilegioDM();
			if ($dataDomingoM > 0) {
				$data['domingom'] = $dataDomingoM;
			}
			
			$dataDomingoT = $this->model->selectVerPrivilegioDT();
			if ($dataDomingoT > 0) {
				$data['domingot'] = $dataDomingoT;
			}
			
			$dataSabado = $this->model->selectPrivilegiosSabado();
			if ($dataSabado > 0) {
				$data['sabado'] = $dataSabado;
			}
			
			$dataMartes = $this->model->selectPrivilegiosMartes();
			if ($dataMartes > 0) {
				$data['martes'] = $dataMartes;
			}
			
			$dataJueves = $this->model->selectPrivilegiosJueves();
			if ($dataJueves > 0) {
				$data['jueves'] = $dataJueves;
			}
			
		
			$this->views->getView($this,"privilegiosweb",$data);
		}

	
	}
 ?>