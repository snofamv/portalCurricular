<?php
require_once "models/usuario_model.php";

class RegistroController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->vista->render("login/registro", []);
    }

    function nuevoUsuario()
    {
        if ($this->existsPOST(["rut", "clave"])) {
            $rut = $this->getPOST("rut");
            $clave = $this->getPOST("clave");

            //esto se debe validar aun mas desde elservidor y front con js
            if ($rut == "" || empty($rut) || $clave == "" || empty($clave)) {
                $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_VACIO]);
            } else if (strlen($rut) < 4 || strlen($clave) < 4) {
                $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_CAMPOS_MINIMOS]);
            } else {


                $objUsuario = new UsuarioModel();
                $objUsuario->setRut($rut);
                $objUsuario->setClave($clave);
                $objUsuario->setRol("user");
                //esto funciona correctamente al registrar un usuario pero no retorna el mensaje
                if ($objUsuario->existeUsuario($rut)) {
                    $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_EXISTE]);
                } else if ($objUsuario->__guardarDato()) {
                    $this->redirect("", ["success" => SuccessMessages::SUCCESS_REGISTRO_NUEVOUSUARIO]);
                } else {
                    $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO_ERROR]);
                }
            }
        } else {
            $this->redirect("registro", ["error" => ErrorMessages::ERROR_REGISTRO_NUEVOUSUARIO]);
        }
    }
}
