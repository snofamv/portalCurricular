<?php
class Actualizar extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->cargarModelo("alumno");
    }

    public function render()
    {
        if ($rut = $this->getGET("rut")) {
            $d = $this->modelo->__getDatoById($rut);
            $this->vista->render("panel/actualizar", $d);
        } else {
            $this->redirect("lista", []);
        }
    }

    public function actualizarAlumno()
    {
        //esto debe ser validado por si recibe campos o valores vacios en la vista
        if ($_POST && $this->getPOST("btnActualizarAlumno")) {
            $m = new Alumno();
            $m->setCodigo($_POST["codigo"]);
            $m->setRut($this->getPOST("rutModificar"));
            $m->setNombres($this->getPOST("nombres"));
            $m->setApellidos($this->getPOST("apellidos"));
            $m->setSede($this->getPOST("sedes"));
            $m->setCarrera($this->getPOST("carreras"));
            if($m->__actualizarDato()){
                $this->redirect("lista", ["success" => SuccessMessages::SUCCESS_REGISTROACTUALIZADO_ALUMNO]);
                error_log("ActualizarController::Alumno actualizado con exito.");
            }else{
                $this->redirect("lista", ["error" => ErrorMessages::ERROR_ACTUALIZAR_ALUMNO]);
                error_log("ActualizarController::Error al actualizar el alumno.");
            }
        }
    }
}
