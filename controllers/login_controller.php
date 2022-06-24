<?php
require_once "classes/etc/session_controller.php";
class LoginController extends SessionController
{

    function __construct()
    {
        error_log("LOGIN::CONTROLLER => CONTROLADOR INICIADO.");
        parent::__construct();
    }

    public function render()
    {
        error_log("LOGIN::CONTROLLER -> VISTA CARGADA.");
        $this->vista->render("login/index", []);
    }

    public function authenticate()
    {
        
        if ($this->existsPOST(["usuario", "contrasena"])) {
            $usuario = $this->getPOST("usuario");
            var_dump($usuario);
            $contrasena = $this->getPOST("contrasena");
            // if ($usuario == "" || empty($usuario) || $contrasena == "" || empty($contrasena)) {
            //     $this->redirect("", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_VACIO]);
            // }

            $user = $this->modelo->login($usuario, $contrasena);

            if ($user != NULL) {
                $this->initialize($user);
            } else {
                $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
            }
        }
    }

    // function acceder()
    // {
    //     if ($_POST) {
    //         if ($this->validarAcceso($this->getPOST("rut"), $this->getPOST("clave")) != NULL) {
    //             $obj = $this->validarAcceso($this->getPOST("rut"), $this->getPOST("clave"));
    //             $this->getSesion()->setNomSesion($obj->getNombre());
    //             $this->depurar($obj);
    //             $this->depurar($_SESSION);

    //             //$this->redirect("panel", ["success" => SuccessMessages::SUCCESS_ACCESO_CONCEDIDO]);
    //         } else {
    //             $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
    //         }
    //     } else {
    //         $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
    //     }
    // }

    // private function validarAcceso($r, $c)
    // {
    //     if ($m = $this->modelo->login($r, $c)) {
    //         return $m;
    //     } else {
    //         return NULL;
    //     }
    // }

    // private function encriptarDato($encryptedTxt)
    // {
    //     $crypt = crypt($encryptedTxt, PASSWORD_DEFAULT);
    //     return $crypt;
    // }
}
