<?php
require_once "classes/etc/session.php";
require_once "models/usuario_model.php";
class SessionController extends Controller
{
    private $usuario;
    private $nomUsuario;
    private $idUsuario;
    private $sessionUsuario;
    private $session;
    private $sitios = array(
        [
            "sitio" => "",
            "acceso" => "publico",
            "rol" => "",
        ],
        [
            "sitio" => "login",
            "acceso" => "publico",
            "rol" => "",
        ],
        [
            "sitio" => "registro",
            "acceso" => "publico",
            "rol" => "",
        ],
        [
            "sitio" => "panel",
            "acceso" => "privado",
            "rol" => "user",
        ],
        [
            "sitio" => "lista",
            "acceso" => "privado",
            "rol" => "user",
        ],
        [
            "sitio" => "buscar",
            "acceso" => "privado",
            "rol" => "user",
        ],
        [
            "sitio" => "actualizar",
            "acceso" => "privado",
            "rol" => "user",
        ],
        [
            "sitio" => "agregar",
            "acceso" => "privado",
            "rol" => "user",
        ],
    );

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function init()
    {
        $this->session = new Session();
        $this->validarSession();
    }

    // private function existsSession()
    // {
    //     if (!$this->session->exists()) return false;
    //     if ($this->session->getCurrentUser() == NULL) return false;

    //     $userid = $this->session->getCurrentUser();
    //     if ($userid) return true;

    //     return false;
    // }

    private function redirectDefaultSiteByRol($rol)
    {
        $url = "";
        for ($i = 0; $i < sizeOf($this->sitios); $i++) {
            if ($this->sitios[$i]["rol"] == $rol) {
                $url = "" . $this->sitio[$i]['sitio'];
                break;
            }
        }

        header("location: " . $url, 301);
    }
    private function isAuthorized($rol)
    {
        $url = $this->getPaginaActual();
        $url = preg_replace("/\?.*/", "", $url);

        for ($i = 0; $i < sizeof($this->sitios); $i++) {
            if ($url == $this->sitios[$i]['sitio'] && $this->sitios[$i]["rol"] == $rol) {
                return true;
            }
        }
        return false;
    }

    public function initialize($user)
    {
        #solo se guarda el id
        $this->session->setCurrentUser($user->getId());
        $this->autorizarAcceso($user->getRol());
    }

    public function autorizarAcceso($rol)
    {
        if ($rol === "user") {
            $this->redirect("panel", []);
        } else {
            $this->redirect("", []);
        }
    }
    private function getPaginaActual()
    {
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode("/", $actualLink);
        isset($url[2]) ? error_log("SessionController::getPaginaActual -> /" . $url[1] . "/".$url[2]) : error_log("SessionController::getPaginaActual -> /" . $url[1]);
        return isset($url[2]) ? $url[2] : $url[1];
    }
    public function salir()
    {
        $this->session->closeSession();
    }

    private function existeSesion()
    {
        return $this->session->existeSesion();
    }
    private function getUsuarioSessionData()
    {
        $id = $this->session->getCurrentUser();
        $this->usuario = new UsuarioModel();
        $this->usuario->get($id);
        return $this->usuario;
    }
    private function isPublic()
    {
        $url = $this->getPaginaActual();
        $url = preg_replace("/\?.*/", "", $url);

        for ($i = 0; $i < sizeof($this->sitios); $i++) {
            if ($url == $this->sitios[$i]['sitio'] && $this->sitios[$i]["acceso"] == "publico") {
                return true;
            }
        }
        return false;
    }

    private function validarSession()
    {
        error_log("SessionController::ValidarSesion()");
        if ($this->existeSesion()) {
            error_log("SessionController::ValidarSesion() Existe sesion.");
            $rol = $this->getUsuarioSessionData()->getRol();
            error_log("SessionController::ValidarSesion() Existe rol sesion. -> $rol");

            if ($this->isPublic()) {
                $this->redirect("", []);
            } else {
                error_log("SessionController::ValidarSesion() -> El sitio es privado.");
                if ($this->isAuthorized($rol)) {
                    error_log("SessionController::ValidarSesion() -> El usuario esta autorizado.");
                } else {
                    $this->redirectDefaultSiteByRol($rol);
                }
            }
        } else {
            #no existe session
            if ($this->isPublic()) {
                //no pasa nada, lo deja entrar;
            } else {
                header("Location: ". URLBASE . "");
            }
        }
    }
}