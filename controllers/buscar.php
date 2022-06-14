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
        $this->vista->render("panel/buscar", []);
    }

    public function rut()
    {   
        if($_POST){

            echo $_POST['rut'];
           $obj = $this->modelo->__getDatoById($_POST['rut']);
            var_dump($obj);
            // echo $_POST['rut'];
            // echo "<br>";
            // print_r($this->modelo);
        }
    }
}
