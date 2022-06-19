<?php
require_once "classes/etc/session.php";
require_once "models/usuario_model.php";
class SessionController extends Controller
{
    private $sesion, $sitios;

    public function __construct()
    {
        parent::__construct();
        $this->sitios = array(["sitio" => "panel", "role" => "user", "acceso" => "privado"], ["sitio" => "lista", "role" => "user", "acceso" => "privado"], ["sitio" => "buscar", "role" => "user", "acceso" => "privado"], ["sitio" => "panel", "role" => "user", "acceso" => "privado"], ["sitio" => "login", "role" => "", "acceso" => "privado"], ["sitio" => "panel", "role" => "", "acceso" => "privado"]);
        $this->init();
    }

    function init(){
        $this->sesion = new Session();
        $this->validarSesion();
    }

    function validarSesion()
    {
        error_log("SessionController::ValidandoSesion() -> 1");
        //si existe sesion
        if ($this->sesion->existeSesion()) {
            #$this->modelo->login($rut, $clave) != NULL
            error_log("SessionController::ValidandoSesion() -> 2. Dentro del if existeSesion()");
            // //si la pagina a entrar es publica
            // if ($this->esPublica()) {
            //     $this->redirectDefaultSiteByRole($rol);
            // } else {
            //     if ($this->isAuthorized($rol)) {
            //         //lo dejo pasar
            //     } else {
            //         $this->redirectDefaultSiteByRole($rol);
            //     }
            // }
            return true;
        } else {
            error_log("Error en else final.");
            // //no existe la sesion
            // if ($this->esPublica()) {
            //     //no pasa nada, lo dejamos entrar

            // } else {
            //     header("location: " . URLBASE . "/");
            //     //$this->redirect("", ["error"=>ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
            // }
            return false;
        }
    }

    public function getSesion()
    {
        return $this->sesion;
    }
}
