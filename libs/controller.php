<?php

class Controller
{
    function __construct()
    {
       
        $this->vista = new View();
    }

    public function cargarModelo($nomModelo)
    {
        $ruta = "models/" . $nomModelo . ".php";
        if ($nomModelo != null) {
            # code...
            if (file_exists($ruta)) {
                error_log("Controller::CargarModelo $nomModelo.");
                require_once $ruta;
                $this->modelo = new $nomModelo();
            }
        }
    }

    function existsPOST($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                error_log("Controlador::ExistsPOST => No existe el parametro $param");
                return false;
            }
        }
        return true;
    }
    function existsGET($params)
    {
        foreach ($params as $param) {
            if (!isset($_GET[$param])) {
                error_log("Controlador::ExistsPOST => No existe el parametro $param");
                return false;
            }
        }
        return true;
    }

    function getGET($param)
    {
        return $_GET[$param];
    }
    function getPOST($param)
    {
        return $_POST[$param];
    }



    function redirect($ruta, $mensajes)
    {
        $datos = [];
        $params = "";
        foreach ($mensajes as $key => $mensaje) {
            array_push($datos, $key . "=" . $mensaje);
        }
        $params = join("&", $datos);
        //?nombre=Marcos&apellido=rivas
        if ($params != "") {
            $params = "?" . $params;
        }
        header("Location: " . URLBASE. "/" . $ruta . $params);
    }
}
