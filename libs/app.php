<?php
require_once "controllers/errores.php";
class App
{
    function __construct()
    {
        error_log("APP::__CONSTRUCT INSTANCIADO.");
        //la primera posicion llama al controlador
        //la segunda posicion llama a los metodos
        //la tercera y cuarta corresponde a parametros etc // -> aun no implementado <-
        $url = isset($_GET["url"]) ? $_GET["url"] : NULL;
        $url = rtrim($url, "/");
        $url = explode("/", $url);

        //$controladorBase = "controllers/$url[0].php";
        //validacion URL
        if (empty($url[0])) {
            #index.php/
            error_log("APP::CARGANDO CONTROLADOR LOGIN");
            require_once "controllers/login.php";
            $controlador = new Login();
            $controlador->render();
            return false;
        }

        $controladorRuta = "controllers/$url[0].php";
        //si existe controlador
        if (file_exists($controladorRuta)) {
            //se ejecuta controlador encontrado
            require_once $controladorRuta;
            $controlador = new $url[0];

            //si una segunda url
            //  /login/salir
            // login es la vista y salir el metodo
            //si existe URL[1]
            if (isset($url[1])) {
                //si existe metodo en el controlador
                if (method_exists($controlador, $url[1])) {
                    //BLOQUE DE CODIGO//
                    //ESTE BLOQUE DE CODINCIONALES DEFINE LOS PARAMETROS DENTRO DE LA 2 Y 3RA EN ADELANTE URL
                    if (isset($url[2])) {
                        //nro de parametros en URL
                        $nparam = count($url) - 2;
                        //arreglo de los parametros en URL
                        $params = array();
                        for ($i = 0; $i < $nparam; $i++) {
                            array_push($params, $url[$i] + 2);
                        }
                        $controlador->{$url[1]}($params);
                    } else {
                        #si no tiene parametros, se manda a llamar
                        //se ejecuta el metodo existente en URL[1]
                        $controlador->{$url[1]}();
                    }

                } else {
                    //SI no existe el metodo URL[1] envia ERROR
                    error_log("APP::METODO EN CONTROLADOR NO ENCONTRADO.");
                    $controlador = new Errores();
                    $controlador->render();
                }
            } else {
                //si no hay metodo
                //No hay metodo a cargar, se carga el metodo RENDER  por default.
                //este metodo lo deben llevar todas las clases controladoras extendidas para renderizar desde desde la clase VIEW padre
                error_log("APP::RENDERIZANDO VISTA -> [{$url[0]}]");
                $controlador->render();
            }
        } else {
            //no existe el controlador.
            error_log("APP::CONTROLADOR NO ENCONTRADO.");
            $controlador = new Errores();
            $controlador->render();
        }
    }
}
