<?php
require_once "classes/etc/session_controller.php";
class LoginController extends SessionController
{

    function __construct()
    {
        error_log("LOGIN::CONTROLLER => CONTROLADOR INICIADO.");
        parent::__construct();
        $this->cargarModelo("login");
    }

    public function render()
    {
        error_log("LOGIN::CONTROLLER -> VISTA CARGADA.");
        $this->vista->render("login/index", []);
    }
    function acceder()
    {
        if ($_POST) {
            if ($this->validarAcceso($this->getPOST("rut"), $this->getPOST("clave")) != NULL) {
                $obj = $this->validarAcceso($this->getPOST("rut"), $this->getPOST("clave"));
                $this->getSesion()->setNomSesion($obj->getNombre());
                $this->depurar($obj);
                $this->depurar($_SESSION);

                //$this->redirect("panel", ["success" => SuccessMessages::SUCCESS_ACCESO_CONCEDIDO]);
            } else {
                $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
            }
        } else {
            $this->redirect("", ["error" => ErrorMessages::ERROR_AUTENTICACION_LOGIN_INVALIDO]);
        }
    }

    private function validarAcceso($r, $c)
    {
        if ($m = $this->modelo->login($r, $c)) {
            return $m;
        } else {
            return NULL;
        }
    }

    private function encriptarDato($encryptedTxt)
    {
        $crypt = crypt($encryptedTxt, PASSWORD_DEFAULT);
        return $crypt;
    }
}
