<?php 

	class AlabanzaswebModel extends Mysql
	{
		private $intIdAlabanza;
		private $strNombre;
		private $strAlabanza;

		public function __construct()
		{
			parent::__construct();
		}	

		
		public function selectCancionero()
		{
			$sql = "SELECT * FROM alabanza";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectAlabanza(int $idalabanza){
			$this->intIdAlabanza = $idalabanza;
			$sql = "SELECT * FROM alabanza
					WHERE id = $this->intIdAlabanza";
			$request = $this->select($sql);
			return $request;
		}
	
	}
 ?>