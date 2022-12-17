<?php 

	class Bibliaweb extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function BibliaRV()
		{
			$data['page_tag'] = "Bíblia Reina Valera 1960";
			$data['page_title'] = "Bíblia Reina Valera 1960 <small>IEPP</small>";
			$data['page_name'] = "bibliarv";
			$this->views->getView($this,"bibliaRVIndice",$data);
		}

		public function BibliaHB()
		{
			$data['page_tag'] = "Holy Bible";
			$data['page_title'] = "Holy Bible 1960 <small>IEPP</small>";
			$data['page_name'] = "bibliahb";
			$this->views->getView($this,"bibliaHBIndice",$data);
		}


		public function Libro($params)
		{
			$parametros = explode(',', $params);
			$idlibro = $parametros[0];
			$idcap = $parametros[1];
			$datos = @file_get_contents(base_url().'/Biblias/indiceBiblia.json');
			$libros = json_decode($datos, true);
					foreach ($libros as $libro) {
						
						if ($libro['numero'] == $idlibro) {
							$nombrelibro=$libro['titulo'];
							$totalcap=$libro['cap'];
						}
					}
			$url=urlencode(base_url().'/Biblias/Biblia/'.$nombrelibro.'/Capitulo'.$idcap.'.json');
			$datos1 = @file_get_contents(urldecode($url));
			$libroseleccionado = json_decode($datos1, true);

			$data['page_tag'] = $libroseleccionado[0]['libro'].' '.$idcap;
			$data['page_title'] = $libroseleccionado[0]['libro'];
			$data['idlibro'] = $idlibro;
			$data['libro'] = $libroseleccionado[0]['libro'];
			$data['capitulo'] = $libroseleccionado[0]['capitulo'];
			$data['versiculos'] = $libroseleccionado[0]['versiculos'];
			$data['totalcap'] = $totalcap;
			$this->views->getView($this,"capituloBRV",$data);
			
		}

		public function Book($params)
		{
			$parametros = explode(',', $params);
			$idlibro = $parametros[0];
			$idcap = $parametros[1];
			$datos = @file_get_contents(base_url().'/Biblias/indiceBible.json');
			$libros = json_decode($datos, true);
					foreach ($libros as $libro) {
						
						if ($libro['numero'] == $idlibro) {
							$nombrelibro=$libro['titulo'];
							$totalcap=$libro['cap'];
						}
					}

			$datos1 = @file_get_contents(base_url().'/Biblias/Bible/'.$nombrelibro.'/Capitulo'.$idcap.'.json');
			$libroseleccionado = json_decode($datos1, true);

			$data['page_tag'] = $libroseleccionado[0]['libro'].' '.$idcap;
			$data['page_title'] = $libroseleccionado[0]['libro'];
			$data['idlibro'] = $idlibro;
			$data['libro'] = $libroseleccionado[0]['libro'];
			$data['capitulo'] = $libroseleccionado[0]['capitulo'];
			$data['versiculos'] = $libroseleccionado[0]['versiculos'];
			$data['totalcap'] = $totalcap;
			$this->views->getView($this,"capituloHB",$data);
		}

		public function Versiculo($params)
		{
			$parametros = explode(',', $params);
			$idlibro = $parametros[0];
			$idcap = $parametros[1];
			$idversiculo = $parametros[2];
			$datos = @file_get_contents(base_url().'/Biblias/indiceBiblia.json');
			$libros = json_decode($datos, true);
					foreach ($libros as $libro) {
						
						if ($libro['numero'] == $idlibro) {
							$nombrelibro=$libro['titulo'];
						}
					}

			$datos1 = @file_get_contents(base_url().'/Biblias/Biblia/'.$nombrelibro.'/Capitulo'.$idcap.'.json');
			$libroseleccionado = json_decode($datos1, true);
			//dep($libroseleccionado);
			$numverso=$idversiculo+1;
			$data['page_tag'] = $libroseleccionado[0]['libro'].' '.$idcap.': '.$numverso;
			$data['page_title'] = $libroseleccionado[0]['libro'];
			$data['idlibro'] = $idlibro;
			$data['libro'] = $libroseleccionado[0]['libro'];
			$data['capitulo'] = $libroseleccionado[0]['capitulo'];
			$data['idversiculo'] = $idversiculo+1;
			$data['versiculo'] = $libroseleccionado[0]['versiculos'][$idversiculo];
			$this->views->getView($this,"versiculoBRV",$data);
		}
		
		public function VersiculoHB($params)
		{
			$parametros = explode(',', $params);
			$idlibro = $parametros[0];
			$idcap = $parametros[1];
			$idversiculo = $parametros[2];
			$datos = @file_get_contents(base_url().'/Biblias/indiceBible.json');
			$libros = json_decode($datos, true);
					foreach ($libros as $libro) {
						
						if ($libro['numero'] == $idlibro) {
							$nombrelibro=$libro['titulo'];
						}
					}

			$datos1 = @file_get_contents(base_url().'/Biblias/Bible/'.$nombrelibro.'/Capitulo'.$idcap.'.json');
			$libroseleccionado = json_decode($datos1, true);
			//dep($libroseleccionado);
			$numverso=$idversiculo+1;
			$data['page_tag'] = $libroseleccionado[0]['libro'].' '.$idcap.': '.$numverso;
			$data['page_title'] = $libroseleccionado[0]['libro'];
			$data['idlibro'] = $idlibro;
			$data['libro'] = $libroseleccionado[0]['libro'];
			$data['capitulo'] = $libroseleccionado[0]['capitulo'];
			$data['idversiculo'] = $idversiculo+1;
			$data['versiculo'] = $libroseleccionado[0]['versiculos'][$idversiculo];
			$this->views->getView($this,"versiculoHB",$data);
		}
	}
 ?>