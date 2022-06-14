<?php
class Eliminar extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->cargarModelo("alumno");
    }

    public function render()
    {
        if ($this->getGET("rut")) {
            $this->vista->render("panel/eliminar", $d = $this->modelo->__getDatoById($this->getGET("rut")));
        } else {
            $this->redirect("lista", []);
        }
    }

    public function eliminarAlumno()
    {
        if ($_POST && $this->getPOST("btnEliminarAlumno")) {

            if ($this->modelo->__borrarDatoById($this->getPOST("rutEliminar"))) {
                $this->redirect("lista", ["success" => SuccessMessages::SUCCESS_REGISTROELIMINADO_ALUMNO]);
                error_log("EliminarController::ALumno eliminado.");
            } else {
                $this->redirect("lista", ["error" => ErrorMessages::ERROR_ELIMINARALUMNO_ERROR]);
            }
        }
    }
}
