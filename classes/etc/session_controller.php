<?php
require_once "classes/etc/session.php";
require_once "models/usuario_model.php";
class SessionController extends Controller
{
    private $usuario;
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
            "sitio" => "panelLector",
            "acceso" => "privado",
            "rol" => "lector",
        ],
        [
            "sitio" => "lista",
            "acceso" => "privado",
            "rol" => "lector",
        ],
        [
            "sitio" => "buscar",
            "acceso" => "privado",
            "rol" => "lector",
        ],
        [
            "sitio" => "panel",
            "acceso" => "privado",
            "rol" => "usuario",
        ],
        [
            "sitio" => "lista",
            "acceso" => "privado",
            "rol" => "usuario",
        ],
        [
            "sitio" => "buscar",
            "acceso" => "privado",
            "rol" => "usuario",
        ],
        [
            "sitio" => "actualizar",
            "acceso" => "privado",
            "rol" => "usuario",
        ],
        [
            "sitio" => "agregar",
            "acceso" => "privado",
            "rol" => "usuario",
        ],
        [
            "sitio" => "panel",
            "acceso" => "privado",
            "rol" => "admin",
        ],
        [
            "sitio" => "lista",
            "acceso" => "privado",
            "rol" => "admin",
        ],
        [
            "sitio" => "buscar",
            "acceso" => "privado",
            "rol" => "admin",
        ],
        [
            "sitio" => "actualizar",
            "acceso" => "privado",
            "rol" => "admin",
        ],
        [
            "sitio" => "agregar",
            "acceso" => "privado",
            "rol" => "admin",
        ],
        [
            "sitio" => "panelAdmin",
            "acceso" => "privado",
            "rol" => "admin",
        ],
        [
            "sitio" => "registro",
            "acceso" => "privado",
            "rol" => "admin",
        ]
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


    private function redirectDefaultSiteByRol($rol)
    {
        $url = "";
        for ($i = 0; $i < sizeOf($this->sitios); $i++) {
            if ($this->sitios[$i]["rol"] === $rol) {
                $url = "" . $this->sitios[$i]['sitio'];
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
            if ($url === $this->sitios[$i]['sitio'] && $this->sitios[$i]["rol"] === $rol) {
                return true;
            }
        }
        return false;
    }

    public function iniciar($user)
    {
        #solo se guarda el id
        $this->session->setCurrentUser($user->getId(), $user->getNombre());
        $this->autorizarAcceso($user->getRol());
    }

    public function autorizarAcceso($rol)
    {
        switch ($rol) {
            case 'lector':
                $this->redirect("panelLector", []);
                break;
            case 'usuario':
                $this->redirect("panel", []);
                break;
            case 'admin':
                $this->redirect("panelAdmin", []);
                break;
            default:
                $this->redirect("", []);
                break;
        }
    }
    private function getPaginaActual()
    {
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode("/", $actualLink);
        return $url[1];
    }
    public function salir()
    {
        $this->session->finalizarSesion();
    }

    private function existeSesion()
    {
        if (!$this->session->existeSesion()) return false;
        if ($this->session->getCurrentUser() === NULL) return false;

        $idUsuario = $this->session->getCurrentUser();
        if ($idUsuario) return true;

        return false;
    }
    private function getUsuarioSessionData()
    {
        #Se encarga de recibir el nombre de la session desde el objeto session y se rescata el id.
        $usrId = $this->session->getCurrentUser()["id"];
        $this->usuario = new UsuarioModel();
        #el parametro es el RUT
        $this->usuario->getById($usrId);
        return $this->usuario;
    }
    private function isPublic()
    {
        #metodo encargado de recorrer array de sitios y verificar si segun su acceso es publico o privado.
        $url = $this->getPaginaActual();
        $url = preg_replace("/\?.*/", "", $url);

        for ($i = 0; $i < sizeof($this->sitios); $i++) {
            if ($url === $this->sitios[$i]['sitio'] && $this->sitios[$i]["acceso"] === "publico") {
                return true;
            }
        }
        return false;
    }

    private function validarSession()
    {
        #Validar sesion
        if ($this->existeSesion()) {
            #si existe sesion obtenemos los datos del usuario objeto y su dato Rol
            $rol = $this->getUsuarioSessionData()->getRol();
            if ($this->isPublic()) {
                #se verifica si el sitio es publico y se redirecciona
                $this->redirectDefaultSiteByRol($rol);
            } else {
                #si es privado se verifica segun el ROL si esta autorizado al sitio.
                if ($this->isAuthorized($rol)) {
                    #si esta autorizado lo dejo continuar en el flujo.
                } else {
                    #si no esta autorizado se redirecciona al sitio por rol.
                    $this->redirectDefaultSiteByRol($rol);
                }
            }
        } else {
            #no existe session
            if ($this->isPublic()) {
                #no pasa nada, lo deja entrar al sitio publico;
            } else {
                #si no tiene sesion y tampoco est en un sitio publico lo redirecciono al index
                header("Location: " . URLBASE . "");
            }
        }
    }
}
