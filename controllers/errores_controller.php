<?php

class ErroresController extends SessionController
{
    function __construct()
    {
        //forma de agregar datos a la vista a travez del metodo getVista
        //los datos son heredados de la clase view a la vista incluida en la clase
        parent::__construct();
        error_log("Errores::__construct => CLASE_INSTANCIADA");
    }
    function render()
    {
        $this->vista->render("error/index", $d = "Controlador no encontrado.");
    }
}
