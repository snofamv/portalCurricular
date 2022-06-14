<?php
//la clase vista se encarga de Render() las vistas a travez
// de herencia con el controlador
class View
{


    function __construct()
    {
    }

    //metodo render muestra una vista segun el parametro definido (url)
    function render($nombre, $d = [], $d2 = null)
    {
        
        $this->datos = $d;
        $this->datos2 = $d2;
        $this->handleMessages();
        require "views/$nombre.php";
    }
    public function showMessages()
    {
        $this->showErrors();
        $this->showSuccess();
    }
    public function showErrors()
    {
        if (array_key_exists("error", $this->datos)) {
            echo "<div class='error'> {$this->datos['error']} </div>";
        }
    }
    public function showSuccess()
    {
        if (array_key_exists("success", $this->datos)) {
            echo "<div class='success'> {$this->datos['success']} </div>";
        }
    }

    public function handleMessages()
    {
        if (isset($_GET["success"]) && isset($_GET["error"])) {
            //error
        } elseif (isset($_GET["success"])) {
            $this->handleSuccess();
        } elseif (isset($_GET["error"])) {
            $this->handleError();
        }
    }
    private function handleError()
    {
        $hash = $_GET["error"];
        $error = new ErrorMessages();
        if ($error->existsKey($hash)) {
            $this->datos["error"] = $error->get($hash);
        }
    }
    private function handleSuccess()
    {
        $hash = $_GET["success"];
        $success = new SuccessMessages();
        if ($success->existsKey($hash)) {
            $this->datos["success"] = $success->get($hash);
        }
    }


}
