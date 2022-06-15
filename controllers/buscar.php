<?php
class Buscar extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->cargarModelo("alumno");
    }

    public function render()
    {
        $this->vista->render("panel/buscar", $d = []);
    }

    public function rut()
    {
        if ($_GET && $rut = $this->getGET("rut")) {
            $alumno = new Alumno();
            $alumno->__getDatoById($rut);
            $d = $alumno->__getDatosToArray();
            #var_dump($this->vista->datos);
            $this->vista->render("panel/buscar", $d);
        } else {
            $this->redirect("buscar", ["error" => ErrorMessages::ERROR_BUSCAR_ALUMNO_NOENCONTRADO_CAMPO_RUT]);
        }
    }
}
