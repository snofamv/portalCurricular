<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">


    <title>Portal Curricular</title>
</head>

<body class="d-flex flex-column ">

    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden min-vh-100">
        <style>
            .background-radial-gradient {
                background-color: hsl(37, 90%, 61%);
                background-image: radial-gradient(650px circle at 0% 0%,
                        hsl(204, 70%, 72%) 18%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                        hsl(204, 70%, 63%) 15%,
                        hsl(218, 41%, 45%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%);
            }

            #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#FCF3CF, #F39C12);
                overflow: hidden;
            }

            #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#F7DC6F, #F39C12);
                overflow: hidden;
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }
        </style>

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Portal<br />
                        <span style="color: hsl(218, 81%, 75%)">Curricular</span>

                    </h1>

                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <div class="mb-3">
                                <a class="navbar-brand" href="/"><img class="row" src="https://cftpucv.cl/wp-content/uploads/2020/10/logo-CFT-PUCV-con-catolica.png" alt="" width="500px"></a>
                            </div>

                            <span class="h5" id="alerta">

                                <?php if (!empty($this->datos) && isset($this->datos["success"])) : ?>

                                    <div class="alert alert-success alert-dismissible d-flex align-items-center" style="width: 100%;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="currentColor" class="bi bi-information-triangle-fill" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <p class="ps-4 font-monospace">
                                            <strong><?php $this->showMessages(); ?></strong>
                                        </p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>

                                <?php elseif (!empty($this->datos) && isset($this->datos["error"])) : ?>
                                    <div class="alert alert-danger alert-dismissible d-flex justify-content-center mx-auto" style="width: 100%;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <p class="ps-4 font-monospace">
                                            <strong><?php $this->showMessages(); ?></strong>
                                        </p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                <?php endif; ?>
                            </span>

                            <form action="<?php echo URLBASE; ?>/login/autenticar" method="POST" id="formularioLogin" onsubmit="return validarLogin()">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="text" id="usuario" class="form-control" placeholder="Usuario aqui" name="usuario" required minlength="3" maxlength="4" pattern="[0-9]{4}" title="La usuario solo contiene 4 caracteres de formato numerico." />
                                        <label class="form-label" for="usuario" hidden>Usuario</label>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" id="contrasena" class="form-control" placeholder="Contraseña aqui" name="contrasena" required minlength="3" maxlength="4" pattern="[0-9]{4}" title="La contraseña solo contiene 4 caracteres." />
                                        <label class="form-label" for="contrasena" hidden>Contraseña</label>
                                    </div>


                                    <!-- Submit button -->
                                    <input id="btnIniciarSesion" type="submit" value="Iniciar sesion" class="btn btn-primary">
                                    <!-- Register buttons -->
                                    <div class="text-center mt-4">
                                        <a class="btn btn-secondary btn-block mb-4 " href="<?php echo URLBASE; ?>/registro">Solicitar registro</a>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
    <script>
        const btnEnviar = document.getElementById('btnIniciarSesion');

        const validación = (e) => {
            e.preventDefault();
            const nombreDeUsuario = document.getElementById('usuario');
            const contrasena = document.getElementById('contrasena');
            if (usuario.value === "") {
                alert("Por favor, escribe tu nombre de usuario.");
                usuario.focus();
                return false;
            }

            if (contrasena.value === "") {
                alert("Por favor, escribe tu contrasena");
                contrasena.focus();
                return false;
            }

            if (!contrasenaValida(contrasena.value)) {
                alert("Por favor, escribe una contraseña valida.");
                contrasena.focus();
                return false;
            }
            if (!usuarioValido(usuario.value)) {
                alert("Por favor, escribe un usuario valido.");
                contrasena.focus();
                return false;
            }

            return true; //Se pueden enviar los datos del formulario al servidor
        }

        const contrasenaValida = contrasena => {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(contrasena);
        }
        const usuarioValido = usuario => {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(usuario);
        }

        btnEnviar.addEventListener('click', validacion);
    </script>
    <?php require "views/includes/footer.template.php"; ?>