<?php
class PdfController extends SessionController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        $this->vista->render("admin/pdf", []);
    }
   

   
   
}
