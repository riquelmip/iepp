<?php 

	class HimnariowebModel extends Mysql
	{
		private $intIdAlabanza;
		private $intNumhimnario;
		private $strNombre;
		private $strAlabanza;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectHimnario()
		{
			$sql = "SELECT * FROM himnario";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectAlabanza(int $idalabanza){
			$this->intIdAlabanza = $idalabanza;
			$sql = "SELECT * FROM himnario
					WHERE idalabanza = $this->intIdAlabanza";
			$request = $this->select($sql);
			return $request;
		}
	
	}
 ?>