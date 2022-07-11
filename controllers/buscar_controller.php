<?php
require_once 'controllers/lista_interface.php';
class BuscarController extends SessionController implements ListaInterface
{
    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->vista->render("panel/buscar", $d = []);
    }

    public function alumnoSede()
    {
        $this->cargarModelo("alumno");
        if ($this->existsPOST(["sede", "btnBuscar"])) {
            $d = $this->modelo->__getAlumnosBySede($this->getPOST('sede'));
            if (sizeof($d) > 0) {
                $this->vista->render("panel/buscar", $d);
            } else {
                $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_SEDE_NOEXISTE]);
            }
        } else {
            $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_SEDE]);
        }
    }
    public function alumnoCarrera()
    {
        $this->cargarModelo("alumno");
        if ($this->existsPOST(["carrera", "btnBuscar"])) {
            $alumno = new AlumnoModel();
            $d = $alumno->__getAlumnosByCarrera($this->getPOST('carrera'));
            if (count($d) > 0) {
                $this->vista->render("panel/buscar", $d);
            } else {
                $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_CARRERA_NOEXISTE]);
            }

            //var_dump($d);
        } else {
            $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_CARRERA]);
        }
    }

    public function modificarAlumno()
    {
        if ($this->existsPOST(['btnModificar'])) {
            $this->redirect("actualizar", ["rut" => !empty($this->getPOST("rut")) ? $this->getPOST("rut") : []]);
        }
    }
    public function eliminarAlumno()
    {
    }
}
