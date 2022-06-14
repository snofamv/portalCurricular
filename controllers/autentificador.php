<?php 
require_once "models/usuario.php";
class Autentificador extends Controller
{
    function __construct()
    {
        parent::__construct();
    }


    function acceder()
    {
        $rut = $this->getPOST("rut");
        $clave = $this->getPOST("clave");
        if(empty($rut) && empty($clave)){
            $this->redirect("", ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO);
        } 
        $m = new Usuario();
        $m->setRut($rut);
        $m->setClave($clave);
        var_dump($m->comparePassword($m->getClave(), $m->getRut()));
    }

}
