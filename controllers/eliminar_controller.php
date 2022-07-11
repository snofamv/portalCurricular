<?php
class EliminarController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        #redireccionamiento por default a lista, temporalmente la vista eliminar esta deshabilitada.
        error_log("EliminarController::Error el modulo Eliminar esta deshabilitado.");
        $this->redirect("panel", ["error" => ErrorMessages::ERROR_MODULO_DESHABILITADO]);
    }

    #esto funciona correctamente pero esta deshabilitado
    # public function eliminarAlumno()
    # {
    #     if ($_POST && $this->getPOST("btnEliminarAlumno")) {

    #         if ($this->modelo->__borrarDatoById($this->getPOST("rutEliminar"))) {
    #             $this->redirect("lista", ["success" => SuccessMessages::SUCCESS_REGISTROELIMINADO_ALUMNO]);
    #             error_log("EliminarController::ALumno eliminado.");
    #         } else {
    #             $this->redirect("lista", ["error" => ErrorMessages::ERROR_ELIMINARALUMNO_ERROR]);
    #         }
    #     }
    # }
}
