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
        $elementoAnterior = NULL;
        $elementoAnterior = $this->modelo->get($this->getPOST("rutModificar"));
        //esto debe ser validado por si recibe campos o valores vacios en la vista
        if ($this->existsPOST(["btnActualizarAlumno"])) {
            $array = [$this->getPOST("codigo"),$this->getPOST("precodigo"),$this->getPOST("nombres"),$this->getPOST("apellidos"),$this->getPOST("sedes"),$this->getPOST("carreras")];
            empty($this->getPOST("codigo")) ? $this->modelo->setCodigo($elementoAnterior->getCodigo()) :  $this->modelo->setCodigo($array[0]);
            empty($this->getPOST("precodigo")) ? $this->modelo->setPreCodigo($elementoAnterior->getPreCodigo()) :  $this->modelo->setPreCodigo($array[1]);
            empty($this->getPOST("nombres")) ? $this->modelo->setNombres($elementoAnterior->getNombres()) :  $this->modelo->setNombres($array[2]);
            empty($this->getPOST("apellidos")) ? $this->modelo->setApellidos($elementoAnterior->getApellidos()) :  $this->modelo->setApellidos($array[3]);
            empty($this->getPOST("sedes")) ? $this->modelo->setSede($elementoAnterior->getSede()) :  $this->modelo->setSede($array[4]);
            empty($this->getPOST("carreras")) ? $this->modelo->setCarrera($elementoAnterior->getCarrera()) :  $this->modelo->setCarrera($array[5]);

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
