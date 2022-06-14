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
                <div class="collapse navbar-collapse ms-5 mx-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <button class="btn btn-outline-primary" style="width: 200px;"><a class="nav-link fs-5 fw-normal" href="/panel">Inicio</a></button>
                        </li>

                    </ul>
                    <div class="shadow p-1  m-3 bg-body rounded">
                        <div class="d-flex m-2">
                            <div class="mt-2 me-3">
                                <p class="font-monospace">
                                    <span>Sesion: <?php echo $_SESSION["usuario"] = "Administrador"; ?></span>
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