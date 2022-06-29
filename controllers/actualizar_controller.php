<?php
class ActualizarController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        if ($this->existsGET(['rut'])) {
            $this->cargarModelo("alumno");
            $d = $this->modelo->get($this->getGET('rut'));
            $this->vista->render("panel/actualizar", $d);
        } else {
            $this->redirect("lista", []);
        }
    }

    public function actualizarAlumno()
    {
        $this->cargarModelo("alumno");
        $elementoAnterior = NULL;
        //esto debe ser validado por si recibe campos o valores vacios en la vista
        if ($_POST && $this->existsPOST(["btnActualizarAlumno"])) {
            $elementoAnterior = $this->modelo->get($this->getPOST("rutModificar"));
            $this->modelo->setRut($this->getPOST("rutModificar"));
            empty($this->getPOST("codigo"))  ? $this->modelo->setCodigo($elementoAnterior->getCodigo()) :  $this->modelo->setCodigo($this->getPOST("codigo"));
            empty($this->getPOST("nombres")) ? $this->modelo->setNombres($elementoAnterior->getNombres()) :  $this->modelo->setNombres($this->getPOST("nombres"));
            empty($this->getPOST("apellidos")) ? $this->modelo->setApellidos($elementoAnterior->getApellidos()) :  $this->modelo->setApellidos($this->getPOST("apellidos"));
            empty($this->getPOST("sedes")) ? $this->modelo->setSede($elementoAnterior->getSede()) :  $this->modelo->setSede($this->getPOST("sedes"));
            empty($this->getPOST("carreras")) ? $this->modelo->setCarrera($elementoAnterior->getCarrera()) :  $this->modelo->setCarrera($this->getPOST("carreras"));

            if ($this->modelo->update()) {
                error_log("ActualizarController::Alumno actualizado con exito.");
                $this->redirect("lista", ["success" => SuccessMessages::SUCCESS_REGISTROACTUALIZADO_ALUMNO]);
            } else {
                error_log("ActualizarController::Error al actualizar el alumno.");
                $this->redirect("lista", ["error" => ErrorMessages::ERROR_ACTUALIZAR_ALUMNO]);
            }
        }
    }
}
