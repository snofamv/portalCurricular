<?php
class AgregarController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->cargarModelo("alumno");
        $this->vista->render("panel/agregar", $d = $this->modelo->getSedes());
    }


    public function nuevoAlumno()
    {
        $this->cargarModelo("alumno");
        if ($this->existsPOST(['codigo', 'rut', 'nombres', 'apellidos', 'sedes', 'carreras'])) {
            $this->modelo->setCodigo($this->getPOST("codigo"));
            $this->modelo->setRut($this->getPOST("rut"));
            $this->modelo->setNombres($this->getPOST("nombres"));
            $this->modelo->setApellidos($this->getPOST("apellidos"));
            $this->modelo->setSede($this->getPOST("sedes"));
            $this->modelo->setCarrera($this->getPOST("carreras"));
            if ($this->modelo->existeAlumno($this->getPOST("rut")) === FALSE) {
                if ($this->modelo->save()) {
                    $this->redirect("agregar", ["success" => SuccessMessages::SUCCESS_REGISTRO_NUEVOALUMNO]);
                } else {
                    $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_NUEVOALUMNO]);
                }
            } else {
                $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_YA_EXISTE_ALUMNO]);
            }
        } else {
            $this->redirect("agregar", ["error" => ErrorMessages::ERROR_REGISTRAR_ALUMNO_CAMPOS_VACIOS]);
        }
    }
}
