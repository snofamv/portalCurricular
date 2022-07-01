<?php
require "views/includes/navbar.user.php";
?>

<div class=" container-fluid mt-5">
    <span class="h3">

        <?php if (!empty($this->datos) && isset($this->datos["success"])) : ?>

            <div class="alert alert-success alert-dismissible d-flex justify-content-center mx-auto" style="width: 70%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <p class="ps-4 font-monospace">
                    <strong><?php $this->showMessages(); ?></strong>
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

        <?php elseif (!empty($this->datos) && isset($this->datos["error"])) : ?>
            <div class="alert alert-danger alert-dismissible d-flex justify-content-center mx-auto" style="width: 70%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <p class="ps-4 font-monospace">
                    <strong><?php $this->showMessages(); ?></strong>
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </span>

    <div class="text-center mb-4">
        <h1 class="pt-4" style="color: #FFFFFF;">Formulario</h1>
    </div>

    <div class="">

        <form action="/agregar/nuevoAlumno" method="POST" target="_self">
            <!--  -->
            <!--  -->

            <div class="row m-3">
                <div class="col">
                    <label class="m-2" for="codigo" style="color:#FFFFFF;">Codigo</label>
                    <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Ej: 0001">
                </div>
                <div class="col">
                    <label class="m-2" for="codigo" style="color:#FFFFFF;">Rut</label>
                    <input class="form-control" type="text" name="rut" placeholder="Ej: 11.111.111-0">
                </div>

            </div>

            <div class="row m-3">
                <div class="col">
                    <label class="m-2" for="codigo" style="color:#FFFFFF;">Nombres</label>
                    <input class="form-control" type="text" name="nombres" placeholder="Introducir Nombres">
                </div>
                <div class="col">
                    <label class="m-2" for="codigo" style="color:#FFFFFF;">Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" placeholder="Introducir Apellidos">
                </div>
            </div>

            <div class="row m-3">
                <div class="col">

                    <label class="m-2" for="sedes" style="color:#FFFFFF;">Sede</label>
                    <select class="form-select" name="sedes" id="sedes">
                        <option selected disabled hidden>Selecciona una sede</option>
                        <option value="La Calera">La Calera</option>
                        <option value="Viña del Mar">Viña del Mar</option>
                        <option value="Valparaiso">Valparaiso</option>
                    </select>
                </div>

                <div class="col">

                    <label class="label m-2" for="carreras"  style="color:#FFFFFF;">Carrera</label>
                    <select class="form-select" name="carreras" id="carreras">
                        <option selected disabled hidden>Selecciona una carrera</option>
                        <option value="Tecnico en Informatica">Tecnico en informatica</option>
                        <option value="Tecnico en Enfermeria">Tecnico en enfermeria</option>
                        <option value="construccion">Construccion</option>
                        <option value="gastronomia">Gastronomia</option>
                        <option value="Administracion de Empresas">Administrador de Empresas</option>
                    </select>
                </div>

            </div>
            <div class="row p-4">
                <div class="col"></div>
                <div class="col">
                    <input class="btn btn-success" type="submit" value="Agregar Alumno">
                </div>
                <div class="col">
                    <button class="btn btn-danger" type="reset">Limpiar campos</button>
                </div>
                <div class="col"></div>

            </div>
        </form>
    </div>

</div>

<?php
require "views/includes/footer.template.php";
?>