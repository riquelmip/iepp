<?php 

	//Retorla la url del proyecto
	function base_url()
	{
		return BASE_URL;
	}
    //Retorla la url de Assets
    function media()
    {
        return BASE_URL."/Assets";
    }
    function headerAdmin($data="")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once ($view_header);
    }
    function footerAdmin($data="")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once ($view_footer);        
    }
    function headerWeb($data="")
    {
        $view_header = "Views/Template/header_web.php";
        require_once ($view_header);
    }
    function footerWeb($data="")
    {
        $view_footer = "Views/Template/footer_web.php";
        require_once ($view_footer);        
    }
	//Muestra información formateada
	function dep($data)
    {
        $format  = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }
    function getModal(string $nameModal, $data)
    {
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;        
    }
    function getMesString(int $mes){
        $mesS = "";
        if ($mes === 1) {
            $mesS = "Enero";
        }else if ($mes === 2) {
            $mesS = "Febrero";
        }else  if ($mes === 3) {
            $mesS = "Marzo";
        }else  if ($mes === 4) {
            $mesS = "Abril";
        }else  if ($mes === 5) {
            $mesS = "Mayo";
        }else  if ($mes === 6) {
            $mesS = "Junio";
        }else  if ($mes === 7) {
            $mesS = "Julio";
        }else  if ($mes === 8) {
            $mesS = "Agosto";
        }else  if ($mes === 9) {
            $mesS = "Septiembre";
        }else  if ($mes === 10) {
            $mesS = "Octubre";
        }else  if ($mes === 11) {
            $mesS = "Noviembre";
        }else  if ($mes === 12) {
            $mesS = "Diciembre";
        }

        return $mesS;
    }

    function getDiaString(int $diasemana){
        $strdiasem = "";
					if ($diasemana == 1) {
						$strdiasem = "Domingo";
					}else if ($diasemana == 2) {
						$strdiasem = "Lunes";
					}else if ($diasemana == 3) {
						$strdiasem = "Martes";
					} else if ($diasemana == 4) {
						$strdiasem = "Miércoles";
					} else if ($diasemana == 5) {
						$strdiasem = "Jueves";
					}  else if ($diasemana == 6) {
						$strdiasem = "Viernes";
					} else if ($diasemana == 7) {
						$strdiasem = "Sábado";
					} 

        return $strdiasem;
    }

    function getDiaFecha($fecha){
        $dia = date("d", strtotime($fecha));

        return $dia;
    }
    function getMesFecha($fecha){
        $mes = date("m", strtotime($fecha));

        return $mes;
    }
    function getAnioFecha($fecha){
        $a = date("Y", strtotime($fecha));

        return $a;
    }

    //Envio de correos
    function sendEmail($data,$template)
    {
        $asunto = $data['asunto']; //nombre del correo
        $emailDestino = $data['email']; //el correo al que se le enviara
        $empresa = NOMBRE_REMITENTE; //nombre de la empresa
        $remitente = EMAIL_REMITENTE; //correo desde donde se esta enviando este correo
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n"; //encabezados de correo, version
        $de .= "Content-type: text/html; charset=UTF-8\r\n"; //tipo de contenido que se enviara (html)
        $de .= "From: {$empresa} <{$remitente}>\r\n"; //de donde se esta enviando el correo
        ob_start(); //cargamos en buffer todos los datos que vamos a utilizar
        require_once("Views/Template/Email/".$template.".php"); //el archivo que va a cargar es
        $mensaje = ob_get_clean(); //nos devolvera el archivo que hemos cargado
        $send = mail($emailDestino, $asunto, $mensaje, $de); //envio de correos
        return $send;
    }

    //Obteniendo los permisos del modulo
    function getPermisos(int $idmodulo){
        require_once("Models/PermisosModel.php");
        $objPermisos = new PermisosModel();
        //Obteniendo el id del rol con el que se esta logeado
        $idrol = $_SESSION['userData']['idrol'];
        $arrPermisos = $objPermisos->permisosModulo($idrol);
        //para todos los modulos
        $permisos = "";
        //para un solo modulo
        $permisosMod = "";

        if (count($arrPermisos) > 0) {
            //agregamos los permisosde todos los modulos
            $permisos = $arrPermisos;
            //si existe en la posicion del array lo que pusimos de param: idmoulo, le va a colocar los permisos de ese modulo, sino, le pondra vacio
            $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
        }
        //agregamos esas variables al data de sesion
        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $permisosMod;
    }
    
    function sessionUser(int $idpersona){
        require_once("Models/LoginModel.php");
        $objLogin = new LoginModel();
        $request = $objLogin->sessionLogin($idpersona);
        return $request;
    }

    //Elimina exceso de espacios entre palabras
    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }
    //Genera una contraseña de 10 caracteres
	function passGenerator($length = 10)
    {
        $pass = "";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }
    //Genera un token
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }
    //Formato para valores monetarios
    function formatMoney($cantidad){
        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }
    

 ?>