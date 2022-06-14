<?php
class Buscar extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->vista->render("panel/buscar", []);
    }
}
