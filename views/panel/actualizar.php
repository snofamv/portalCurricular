<?php
require "views/includes/navbar.admin.php";
#D is a data global variable;
?>
<!-- Tabla de datos -->
<div class="container-fluid">


    <div class="row align-items-center p-4">


        <!--  -->
        <div class="col">

            <form action="<?php echo URLBASE;?>/actualizar/actualizarAlumno" method="POST" target="_self">
                <!--  -->
                <!--  -->

                <div class="row m-3">
                    <div class="col">
                        <label for="codigo">Nuevo codigo</label>
                        <input class="form-control" type="text" name="codigo" id="codigo" placeholder="Ej: 0001">
                    </div>

                </div>

                <div class="row m-3">
                    <div class="col">
                        <label for="codigo">Nuevo nombre</label>
                        <input class="form-control" type="text" name="nombres" placeholder="Introducir Nombres">
                    </div>
                    <div class="col">
                        <label for="codigo">Nuevo Apellido</label>
                        <input class="form-control" type="text" name="apellidos" placeholder="Introducir Apellidos">
                    </div>
                </div>

                <div class="row m-3">
                    <div class="col">

                        <label for="sedes">Nueva Sede</label>
                        <select class="form-select" name="sedes" id="sedes" required>
                            <option selected disabled hidden>Selecciona una sede</option>
                            <option value="La Calera">La Calera</option>
                            <option value="Viña del Mar">Viña del Mar</option>
                            <option value="Valparaiso">Valparaiso</option>
                        </select>
                    </div>

                    <div class="col">

                        <label class="label" for="carreras">Nueva Carrera</label>
                        <select class="form-select" name="carreras" id="carreras" required>
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
                        <input type="hidden" name="rutModificar" id="rutModificar" value="<?php echo $d->getRut();?>">
                        <input class="btn btn-success" type="submit" name="btnActualizarAlumno" value="Actualizar Alumno">
                    </div>
                    <div class="col">
                        <input class="btn btn-danger" type=" reset" value="Limpiar campos">
                    </div>
                    <div class="col"></div>

                </div>
            </form>
        </div>

        <div class="col">
            <div class="card text-center mx-auto shadow p-3 mb-5 bg-body rounded" style="width: 22rem;">
                <img src="https://www.svgrepo.com/show/128306/graduate.svg" height="250px;" class="card-img-top" alt="carta alumno<?php echo " {$d->getNombres()} {$d->getApellidos()}";?>">
                <div class="card-body">
                    <h5 class="card-title"><span><?php echo " {$d->getNombres()} {$d->getApellidos()}"; ?></h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p class="fw-bold">Codigo: <span class="fw-normal"><?php echo $d->getCodigo(); ?></span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Rut: <span class="fw-normal"><?php echo $d->getRut(); ?></span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Sede: <span class="fw-normal"><?php echo $d->getSede(); ?></span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Carrera: <span class="fw-normal"><?php echo $d->getCarrera(); ?></span></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</div>
<?php
require "views/includes/footer.template.php";
?>