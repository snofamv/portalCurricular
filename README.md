# portalCurricular
Portal curricular cuenta con 5 modulos los cuales 2 de ellos estan instalados mediante composer
Se requiere una base de datos conectada y configurada directamente con el archivo config.php       

	-PHP 8.                                                                                                                                      
	-mysql                                
	-User defaults:                                                          
	1230 - 1234                                                 
	1234 - 1234                                                             

# Creando un nuevo modulo/vista
Para la creacion de un nuevo modulo primero debemos contemplar si el modulo estara publico o privado (dentro del panel login).
Para crear un controlador publico extendemos del controlador base "lib/controller.php";
Para crear un controlador privado extendemos del controlador base de session "classes/etc/session_controller.php";
Una vez creado el controlador y extendido en su constructor instanciamos el parent::construct.                        
Creamos un metodo llamado render(){this->vista->("carpetavista/nombrevista")}.                    
Una vez declarado el controlador en la carpeta classes/etc/session_ontroller.php vamos a la propiedad $sitios que es un Array[].              
Dentro de ella agrgamos las nuevas propiedades para la ruta de nuestra nueva vista siguiendo la misma estructura.           
    
	Una vista publica (que puede ser vista sin estar logeado) se representa sin el campo "rol".					
       [				
            "sitio" => "nombreVista",                                           
            "acceso" => "privado",                                              
            "rol" => "lector",                                                                                  
        ],                                                                               
        
        Una vista privada (que no puede ser vista sin estar logeado) se representa con el campo "rol".					
        [				
            "sitio" => "nombreVista",                                           
            "acceso" => "privado",                                              
            "rol" => "lector",                                                                                  
        ]
										
# roles
El rol lector solo tiene acceso a la lectura y busqueda.
	 "rol" => "lector"                                                      
El rol usuario solo tiene acceso a la busqueda, lectura, insercion, modificacion.
	  "rol" => "usuario"                                                                    
El rol admin tiene acceso a todos los modulos, busqueda, lectura, insercion, modificacion, PDF, Storage, Creacion de usuarios, modificacion de roles, habilitar/deshabilitar usuarios.
	   "rol" => "admin"                                                             


# Clases
Las clases estan ubicadas dentro de la carpeta classes, estas contienen librerias utilizadas en controladores, aqui pueden ir toda aquellas clases que pretenden dar funcionalidad extra a los controladores.

# Controladores
para la configuracion de los controladores tocar directamente los de la carpeta controllers ya que estos heredan del controlador base de lib.

# Vistas
las vistas estan directamente instanciadas en el controlador mediante la propiedad vista.
La vista tiene una propiedad llamada $d, la cual es enviada como segundo parametro al metodo render() del controlador.
$d se encarga de almacenar toda la informacion previamente evaluada hacia la vista.


		EJ:
		class ErroresController extends SessionController
		{
		    function __construct()
		    {
			//forma de agregar datos a la vista
			//los datos son heredados de la clase view a la vista incluida en la clase
			parent::__construct();

		    }
		    function render()
		    {
			$this->vista->render("error/index", $d = "aqui van los datos a mostrar en la vista.");
		    }
		}

		En la vista html puede ser utilizado segun sea el nombre heredado en el controlador.
		Al llamador a la variable podremos ver toda la informacion enviada desde el controlador a la vista.

# htacces
Oculta los archivos y controla las rutas amigables

# log/depurar
el log informa todas las acciones que tome el sistema, utilizado para la depuracion de errores durante cualquier accion en el sistema.
Para un mejor flujo de trabajo utilizar error_log() para agregar errores al log y ver la situacion actual de cada proceso a evaluar si es requerido.
EJ: error_log("Creando un log");

# carpeta lib
la carpeta lib contiene las clases base que controlan la aplicacion, estas no deben ser configuradas ni tocadas ya que estas heredan a todas las demas clases del proyecto. SI alguna de estas clases es modificara, producira errores graves en el proyecto.

# carpeta models
la carpeta models contiene unas clases representativas de modelos de la base de datos, tales como usuarios, alumnos, y una paginacion.
Estos controlan la informacion que obtiene de la base de datos para ser mostrada a travez de metodos sus datos.

# carpeta views
la carpeta views contiene todo archivo fisico que contiene html, estos estan implementados con el CDN de bootstrap 5, cualquier modificacion a los estilos debe ser directamente en las clases.

# carpeta config
la carpeta config contiene 2 archivos los cuales son las credenciales y el config.php que tiene la configuracion de urlbase esta es muy importante ya qe maneja el redireccionamiento de todo el proyecto.

	-Config.php contiene toda la configuracion principal del proyecto, sin estas NO FUNCIONARA. usuarios, contraseñas, url, host.
	-credencial.json esta credencial no se toca ya que permite el acceso a la API de google storage

# carpeta controllers
El controlador principal esta ubicado en /lib/controller.php
Este extiende a todos los controladores, para crear un nuevo controlador debe estar extendido de este controlador base y agregando el metodo render para instanciar la vista.		

La carpeta controllers almacena todos los controladores creados para cada modulo, si un controlador falla o se elimina existe un fatal error que no deja acceder a tal modulo.						

Tambien pueden implementarse nuevos modulos manteniendo el mismo regimen de nombre por archivo aplicado ya que este es reconocido mediante funciones.			
EJ: nuevocontrolador_controller.php
Cada Controlador instancia un modelo si es requerido con el medotodo cargarModelo podemos cargarlo a nuestra clase y a travez de la clase entregar la 		informacion a nuestra vista, se recomienda cargar los modelos dentro del metodo render/u otro ya que asi evitamos precargas innecesarias si lo instanciamos en el constructor.

# Errores
Los errores son controladores por las clases de la carpeta classes, ErrorMessage y SuccesMessage controla los mensajes de errores y exitó, estos deben ser agregados como propiedades y luego instanciados en el controlador dentro del array asociativo .

	EJ: const ERROR_STORAGE_DESCARGAR_DOCUMENTO = "5845kk12345ñLK545878pppo215OO8cd".					
	Luego en el contructor se agrega dentro del mismo array existente el mismo array pero con su valor 				
	EJ: ErrorMessages::ERROR_STORAGE_DESCARGAR_DOCUMENTO => "Error, no se pudo descargar el documento solicitada.".				
