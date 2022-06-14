<?php 
    interface IModel{
        public function __guardarDato();
        public function __getTodosLosDatos();
        public function __getDatoById($id);
        public function __borrarDatoById($id);
        public function __actualizarDato();
        public function __setDatosDesdeArray($array);
    }

?>