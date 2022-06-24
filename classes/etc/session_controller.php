<?php
require_once "classes/etc/session.php";
require_once "models/usuario_model.php";
class SessionController extends Controller
{
    private $userSession;
    private $username;
    private $userId;
    private $session;
    private $sites;
    private $defaultSites;
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    function init()
    {
        $this->session = new Session();
        $json = $this->getJSONFileConfig();
        $this->sites = $json["sites"];
        $this->defaultSites = $json["default-sites"];
        $this->validateSession();
    }
    private function getJSONFileConfig()
    {
        $string = file_get_contents("config/access.json");
        $json = json_decode($string, true);
        return $json;
    }
    private function existsSession()
    {
        if (!$this->session->exists()) return false;
        if ($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();
        if ($userid) return true;

        return false;
    }
    private function getUserSessionData()
    {
        $id = $this->session->getCurrentUser();
        $this->user = new UsuarioModel();
        $this->user->get($id);
        return $this->user;
    }
    private function isPublic()
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]["access"] == "public") {
                return true;
            }
        }
        return false;
    }
    private function getCurrentPage()
    {
        $actualLink = trim("$_SERVER[REQUEST_URI]");
        $url = explode("/", $actualLink);
        error_log("SESSIONCONTROLLER::GetCurrentPage -> " . $url[2]);
        return $url[2];
    }
    private function redirectDefaultSiteByRol($rol)
    {
        $url = "";
        for ($i = 0; $i < sizeOf($this->sites); $i++) {
            if ($this->sites[$i]["rol"] == $rol) {
                $url = "" . $this->sites[$i]['site'];
                break;
            }
        }

        header("location: " .$url);
    }
    private function isAuthorized($rol)
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);

        for ($i = 0; $i < sizeof($this->sites); $i++) {
            if ($currentURL == $this->sites[$i]['site'] && $this->sites[$i]["rol"] == $rol) {
                return true;
            }
        }
        return false;
    }

    public function initialize($user)
    {
        #solo se guarda el id
        $this->session->setCurrentUser($user->getId());
        $this->authorizeAccess($user->getRol());
    }

    private function authorizeAccess($rol)
    {
        switch($rol){
            case "user":
                $this->redirect($this->defaultSites["user"], []);
                break;
            case "admin":
                $this->redirect($this->defaultSites["admin"], []);
                break;
        }
    }

    public function logout()
    {
        $this->session->closeSession();
    }


    private function validateSession()
    {
        if ($this->existsSession()) {
            $rol = $this->getUserSessionData()->getRol();

            if ($this->isPublic()) {
                $this->redirectDefaultSiteByRol($rol);
            }else{
                if($this->isAuthorized($rol) ){

                }else{
                    $this->redirectDefaultSiteByRol($rol);
                }
            }
        } else {
            #no existe session
            if($this->isPublic()){
                //no pasa nada, lo deja entrar;
            }else{
                header("location: ". URLBASE . "");
            }
        }
    }
}
