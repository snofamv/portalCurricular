<?php
require_once "classes/session.php";
class SessionController extends Controller
{
    private $sesionUsuario, $rutUsuario, $idUsuario, $sesion, $sitios, $user, $sitiosDefault;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function init()
    {
        $this->sesion = new Session();
        $json = $this->getJSONFileConfig();
        $this->sitios = $json["sites"];
        $this->sitiosDefault = $json["default-sites"];
        $this->validarSesion();
    }

    private function getJSONFileConfig()
    {
        $file = file_get_contents("config/access.json");
        $json = json_decode($file, true);
        return $json;
    }

    function validarSesion()
    {
        error_log("SESSION_CONTROLLER => METODO_VALIDATESESSION");
        //si existe sesion
        if ($this->existsSession()) {
            $role = $this->getUserSessionData()->getRol();

            //si la pagina a entrar es publica
            if ($this->isPublic()) {
                $this->redirectDefaultSiteByRole($role);
            } else {
                if ($this->isAuthorized($role)) {
                    //lo dejo pasar
                } else {
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        } else {
            //no existe la sesion
            if ($this->isPublic()) {
                //no pasa nada, lo dejamos entrar

            } else {
                header("location: " . URLBASE . "/");
            }
        }
    }
    private function redirectDefaultSiteByRole($role)
    {
        $url = "";
        for ($i = 0; $i < sizeof($this->sitios); $i++) {
            if ($this->sitios[$i]["role"] == $role) {
                $url = "/" . $this->sitios[$i]["site"];
                break;
            }
        }
        header("location: " . $url);
    }
    private function isAuthorized($role)
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);
        for ($i = 0; $i < sizeof($this->sitios); $i++) {
            if ($currentURL == $this->sitios[$i]["site"] && $this->sitios[$i]["role"] == $role) {
                return true;
            }
        }
        return false;
    }

    function existsSession()
    {
        if (!$this->sesion->exists()) return false;
        if (!$this->sesion->getCurrentUser() == NULL) return false;

        $idUsuario = $this->sesion->getCurrentUser();
        if ($idUsuario) return true;
    }
    function getUserSessionData()
    {
        $id = $this->idUsuario;
        $this->usuario = new Usuario();
        $this->usuario->__getDatoById($id);
        error_log("SESSION_CONTROLLER => METODO_getUserSessionData => " . $this->user->getUsuario());

        return $this->user;
    }

    function isPublic()
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);
        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]["site"] && $this->sites[$i]["access"] == "public") {
                return true;
            } else {
                return false;
            }
        }
    }
    function getCurrentPage()
    {
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode("/", $actualLink);
        error_log("SESSION_CONTROLLER => METODO_getCurrentPage => " . $url[2]);

        return $url[2];
    }

    function authorizeAccess($role)
    {
        switch ($role) {
            case 'user':
                $this->redirect($this->sitiosPredeterminados["user"], []);
            break;
            case 'admin':
                $this->redirect($this->sitiosPredeterminados["admin"], []);
            break;
        }
    }

    function initialize($user)
    {
        $this->session->setCurrentUser($user->getRut());
        $this->authorizeAccess($user->getRol());
    }

     function logout()
    {
        $this->session->closeSession();
    }
}
