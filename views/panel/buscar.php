<?php
require "views/includes/navbar.admin.php";
?>


<span class="h3">
    <?php if (!empty($this->datos) && isset($this->datos["success"])) : ?>

        <div class="alert alert-success alert-dismissible d-flex justify-content-center mx-auto" style="width: 100%;">
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


<!--  -->
<!-- Tabla de datos -->
<!--  -->
<div class="d-flex pt-5">

    <div class="container m-3" style="width: 170%;">

        <div class="">
            <div>
                <form class="d-flex pb-1" action="/buscar/alumnoRut" role="search" method="GET">
                    <input class="form-control" type="search" placeholder="Buscar RUT" aria-label="Buscar" name="rut">
                    <input class="btn btn-success ms-1" type="submit" value="Buscar"></input>
                </form>
            </div>
            <div>
                <form class="d-flex pb-1" action="/buscar/alumnoNombres" role="search" method="GET">
                    <input class="form-control" type="search" placeholder="Buscar Nombre y apellido" aria-label="Buscar" name="nombres">
                    <button class="btn btn-success ms-1" type="submit">Buscar</button>
                </form>
            </div>
            <div>
                <form class="d-flex pb-1" action="/buscar/alumnoSede" role="search" method="GET">
                    <input class="form-control" type="search" placeholder="Buscar Sedes" aria-label="Buscar" name="sede">
                    <button class="btn btn-success ms-1" type="submit">Buscar</button>
                </form>
            </div>
            <div>
                <form class="d-flex pb-1 mb-5" action="/buscar/alumnoCarrera" role="search" method="GET">
                    <input class="form-control" type="search" placeholder="Buscar Carreras" aria-label="Buscar" name="carrera">
                    <button class="btn btn-success ms-1" type="submit">Buscar</button>
                </form>
            </div>

            <!--  -->

            <div class="justify-content-md-center">

                <table class="table table-success table-striped table-hover table-bordered border-primary">

                    <tr>
                        <th>Nro Documento</th>
                        <th>Rut</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Sede</th>
                        <th>Carrera</th>
                        <th>Opciones</th>
                    </tr>
                    <?php if (isset($d) && isset($_GET["rut"])) : echo "rut aca";
                        #var_dump($d);
                    ?>
                    <!-- Resolve this into an objetc:: fabian -->
                        <tr>
                            <td><?php echo $d["codigo"]; ?></td>
                            <td><?php echo $d["rut"]; ?></td>
                            <td><?php echo $d["nombres"]; ?></td>
                            <td><?php echo $d["apellidos"]; ?></td>
                            <td><?php echo $d["sede"]; ?></td>
                            <td><?php echo $d["carrera"]; ?></td>
                            <td>
                                <form action="/lista/modificarAlumno" method="post">
                                    <input type="text" name="rut" id="rut" value="<?php echo $d["rut"]; ?>" hidden>
                                    <input type="submit" value="Modificar" name="btnModificar"></input>
                                </form>
                            </td>
                        </tr>
                    <?php elseif (isset($d) && isset($_GET["sede"])) : ?>
                        <?php foreach ($d as  $alumno) : ?>
                            <tr>
                                <td> <?php echo $alumno->getCodigo(); ?></td>
                                <td> <?php echo $alumno->getRut(); ?></td>
                                <td> <?php echo $alumno->getNombres(); ?></td>
                                <td> <?php echo $alumno->getApellidos(); ?></td>
                                <td> <?php echo $alumno->getCarrera(); ?></td>
                                <td> <?php echo $alumno->getSede(); ?></td>
                                <td>
                                    <form action="/lista/modificarAlumno" method="post">
                                        <input type="text" name="rut" id="rut" value="<?php echo $alumno->getRut(); ?>" hidden>
                                        <input type="submit" value="Modificar" name="btnModificar"></input>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                            <td>No hay datos</td>
                        </tr>
                    <?php endif; ?>
                </table>

            </div>

        </div>
    </div>

    <!--  -->
    <div class="container me-5">
        <?php if (!empty($d)) : ?>
            <div class="card text-center mx-auto shadow p-3 mb-5 bg-body rounded" style="width: 22rem;">
                <img src="https://www.svgrepo.com/show/128306/graduate.svg" height="250px;" class="card-img-top" alt="carta alumno<?php echo "$d[nombres] $d[apellidos]"; ?>">
                <div class="card-body">
                    <h5 class="card-title"><span><?php echo "$d[nombres] $d[apellidos]"; ?></h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p class="fw-bold">Codigo: <span class="fw-normal"><?php echo $d['codigo']; ?></span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Rut: <span class="fw-normal"><?php echo $d['rut']; ?></span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Sede: <span class="fw-normal"><?php echo $d['sede']; ?></span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Carrera: <span class="fw-normal"><?php echo $d['carrera']; ?></span></p>
                    </li>
                </ul>
            </div>
        <?php else : ?>
            <div class="card text-center mx-auto shadow p-3 mb-5 bg-body rounded" style="width: 22rem;">
                <img src="https://www.svgrepo.com/show/128306/graduate.svg" height="250px;" class="card-img-top" alt="carta alumno" ; ?>">
                <div class="card-body">
                    <h5 class="card-title"><span>No hay datos</span></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <p class="fw-bold">Codigo: <span class="fw-normal">No hay datos</span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Rut: <span class="fw-normal">No hay datos</span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Sede: <span class="fw-normal">No hay datos</span></p>
                    </li>
                    <li class="list-group-item">
                        <p class="fw-bold">Carrera: <span class="fw-normal">No hay datos</span></p>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

</div>




<?php
require "views/includes/footer.template.php";
?>