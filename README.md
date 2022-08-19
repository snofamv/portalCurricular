# portalCurricular
Portal curricular cuenta con 5 modulos los cuales 2 de ellos estan instalados mediante composer
Se requiere una base de datos conectada y configurada directamente con el archivo config.php
-PHP 8.
-mysql
User defaults:
1230 - 1234
1234 - 1234


# Controladores
para la configuracion de los controladores tocar directamente los de la carpeta controllers ya que estos heredan del controlador base de lib.

# Vistas
las vistas estan directamente instanciadas en el controlador mediante la propiedad vista.

# htacces
Oculta los archivos y controla las rutas amigables

# log
el log informa todas las acciones que tome el sistema, utilizado para la depuracion de errores durante cualquier accion en el sistema.

# carpeta lib
la carpeta lib contiene las clases base que controlan la aplicacion, estas no deben ser configuradas ni tocadas ya que estas heredan a todas las demas clases del proyecto.

# carpeta models
la carpeta models contiene unas clases representativas de modelos de la base de datos, tales como usuarios, alumnos, y una paginacion.
Estos controlan la informacion que obtiene de la base de datos para ser mostrada a travez de metodos sus datos.

# carpeta views
la carpeta views contiene todo archivo fisico que contiene html, estos estan implementados con el CDN de bootstrap 5, cualquier modificacion a los estilos debe ser directamente en las clases.

# carpeta config
la carpeta config contiene 2 archivos los cuales son las credenciales y el config.php que tiene la configuracion de urlbase esta es muy importante ya qe maneja el redireccionamiento de todo el proyecto.

# carpeta controllers
La carpeta controllers almacena todos los controladores creados para cada modulo, si un controlador falla o se elimina existe un fatal error que no deja acceder a tal modulo.
Tambien pueden implementarse nuevos modulos manteniendo el mismo regimen de nombre aplicado ya que este es reconocido mediante funciones.
Cada Controlador instancia un modelo si es requerido con el medotodo cargarModelo podemos cargarlo a nuestra clase y a travez de la clase entregar la informacion a nuestra vista.

# Errores
Los errores son controladores por las clases de la carpeta classes, ErrorMessage y SuccesMessage controla los mensajes de errores y exitó, estos deben ser agregados como propiedades y luego instanciados en el controlador dentro del array asociativo .
EJ;    const ERROR_STORAGE_DESCARGAR_DOCUMENTO = "5845kk12345ñLK545878pppo215OO8cd".
Luego en el contructor se agrega dentro del mismo array existente el mismo array pero con su valor 
EJ: ErrorMessages::ERROR_STORAGE_DESCARGAR_DOCUMENTO => "Error, no se pudo descargar el documento solicitada.".
