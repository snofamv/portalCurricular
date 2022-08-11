<?php
class ActualizarController extends SessionController
{
    private $elementoAuxiliar;

    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        if ($this->existsGET(['rut'])) {
            $this->cargarModelo("alumno");
            $d = array();
            $d['alumno'] = $this->modelo->getTituladoRut($this->getGET('rut'));
            $d['carreras'] =  $this->modelo->getCarreras();
            $d['sedes'] =  $this->modelo->getSedes();
            $this->vista->render("panel/actualizar", $d);
        } else {
            $this->redirect("lista", []);
        }
    }

    public function actualizarAlumno()
    {
        $this->cargarModelo("alumno");
        $this->elementoAuxiliar = $this->modelo->get($this->getPOST("rutModificar"));
        //esto debe ser validado por si recibe campos o valores vacios en la vista
        if ($this->existsPOST(["btnActualizarAlumno"])) {
            empty($this->getPOST("codigo")) ? $this->modelo->setCodigo($this->elementoAuxiliar->getCodigo()) : $this->modelo->setCodigo($this->getPOST("codigo"));
            empty($this->getPOST("precodigo")) ? $this->modelo->setPreCodigo($this->elementoAuxiliar->getPreCodigo()) : $this->modelo->setPreCodigo($this->getPOST("precodigo"));
            empty($this->getPOST("nombres")) ? $this->modelo->setNombres($this->elementoAuxiliar->getNombres()) : $this->modelo->setNombres($this->getPOST("nombres"));
            empty($this->getPOST("apellidos")) ? $this->modelo->setApellidos($this->elementoAuxiliar->getApellidos()) : $this->modelo->setApellidos($this->getPOST("apellidos"));
            empty($this->getPOST("sede")) ? $this->modelo->setSede($this->elementoAuxiliar->getSede()) : $this->modelo->setSede($this->getPOST("sede"));
            empty($this->getPOST("carrera")) ? $this->modelo->setCarrera($this->elementoAuxiliar->getCarrera()) : $this->modelo->setCarrera($this->getPOST("carrera"));
            empty($this->getPOST("rut")) ? $this->modelo->setRut($this->elementoAuxiliar->getRut()) : $this->modelo->setRut($this->getPOST("rut"));



            if (!empty($this->getPOST("rut"))) {
                if ($this->modelo->update($this->getPOST("rutModificar"))) {

                    error_log("ActualizarController::Alumno actualizado con exito.");
                    $this->redirect("lista", ["success" => SuccessMessages::SUCCESS_REGISTROACTUALIZADO_ALUMNO]);
                } else {
                    error_log("ActualizarController::Error al actualizar el alumno.");
                    $this->redirect("lista", ["error" => ErrorMessages::ERROR_ACTUALIZAR_ALUMNO]);
                }
            } else {
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

    /**
     * Get the value of elementoAuxiliar
     */
    public function getElementoAuxiliar()
    {
        return $this->elementoAuxiliar;
    }

    /**
     * Set the value of elementoAuxiliar
     */
    public function setElementoAuxiliar($elementoAuxiliar): self
    {
        $this->elementoAuxiliar = $elementoAuxiliar;

        return $this;
    }
}
