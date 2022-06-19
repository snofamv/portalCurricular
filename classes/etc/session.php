<?php

class Session
{
    private $nomSesion = NULL;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function existeSesion()
    {
        return isset($_SESSION[$this->nomSesion]);
    }

    public function cerrarSesion()
    {
        $this->nomSesion = NULL;
        session_unset();
        session_destroy();
    }

    /**
     * Get the value of Sesion
     */
    public function getSesion()
    {
        return $_SESSION[$this->nomSesion];
    }

    /**
     * Set the value of Sesion
     *
     * @return  self
     */
    public function setSesion($nom)
    {
        $_SESSION[$this->nomSesion] = $_SESSION[$nom];

        return $this;
    }

    /**
     * Get the value of nomSesion
     */ 
    public function getNomSesion()
    {
        return $this->nomSesion;
    }

    /**
     * Set the value of nomSesion
     *
     * @return  self
     */ 
    public function setNomSesion($nomSesion)
    {
        $this->nomSesion = $nomSesion;

        return $this;
    }
}
