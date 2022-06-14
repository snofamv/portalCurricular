<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title><?php echo BASETITLE; ?></title>
</head>

<body class="bg-primary bg-gradient">
    <div>
        <nav class="navbar navbar-expand-lg bg-light bg-gradient">
            <div class="container-fluid">
                <a class="navbar-brand p-2" href="#"><img class="row" src="https://cftpucv.cl/wp-content/uploads/2020/10/logo-CFT-PUCV-con-catolica.png" alt="" width="300px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/panel">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Servicios
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="nav-item">
                                    <p class="nav-link text-primary font-monospace text-center mt-2 "><b>Perfil: <span><?php echo $_SERVER["usuario_rol"] = "Administrador" ?></span></b> </p>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">

                                </li>

                                <li><a class="dropdown-item" href="/lista">Lista titulados</a></li>
                                <li><a class="dropdown-item" href="/agregar">Agregar alumno titulado</a></li>
                                <li><a class="dropdown-item" href="/buscar">Buscar alumno titulado</a></li>
                                <li><a class="dropdown-item" href="/eliminar">Eliminar alumno titulado</a></li>
                                <li>
                                    <hr class="dropdown-divider">

                                </li>
                                <li><a class="dropdown-item" href="/config">Configurar cuenta</a></li>
                            </ul>
                        </li>

                    </ul>
                    <div class="shadow p-1  m-3 bg-body rounded">
                        <div class="d-flex m-2">
                            <div class="mt-2 me-3">
                                <p class="font-monospace">
                                    <span>Bienvenid@: <?php echo $_SESSION["usuario"] = "Fabian"; ?></span>
                                </p>
                            </div>
                            <form action="/panel/salir" method="POST">
                                <button class="btn btn-outline-danger" type="submit" value="Cerrar sesion">Cerrar sesion</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </div>