<?php
require_once "controllers/lista_interface.php";
class ListaController extends SessionController implements ListaInterface
{
    function __construct()
    {
        parent::__construct();
        $this->cargarModelo("alumno");
    }

    function render()
    {
        $d = $this->modelo->getAll();
        $this->vista->render("panel/lista", $d);
    }

    public function modificarAlumno()
    {

        if ($_POST['btnModificar']) {
            $this->redirect("actualizar", ["rut" => !empty($this->getPOST("rut")) ? $this->getPOST("rut") : []]);
        }
    }
    public function eliminarAlumno()
    {
        if ($_POST['btnEliminar']) {
            $this->redirect("eliminar", ["rut" => !empty($this->getPOST("rut")) ? $this->getPOST("rut") : []]);
        }
    }
}
