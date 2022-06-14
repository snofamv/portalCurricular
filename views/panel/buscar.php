<?php
require "views/includes/navbar.admin.php";
?>

<div class="container mt-2">
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

    <!--  -->
    <?php if ($d) : ?>
        <div class="col">
            <div class="card text-center mx-auto shadow p-3 mb-5 bg-body rounded" style="width: 22rem;">
                <img src="https://www.svgrepo.com/show/128306/graduate.svg" height="250px;" class="card-img-top" alt="carta alumno<?php echo " {$d->getNombres()} {$d->getApellidos()}"; ?>">
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
    <?php endif; ?>
    <!--  -->
    <!-- Tabla de datos -->
    <div>
        <h1 class="text-center mb-3">Buscar titulado</h1>

        <div class="row">
            <div class="col">
                <form class="d-flex pb-1" action="/buscar/rut" role="search" method="post">
                    <input class="form-control" type="search" placeholder="Buscar RUT" aria-label="Buscar" name="rut">
                    <button class="btn btn-success ms-1" type="submit">Buscar</button>
                </form>
            </div>
            <div class="col">
                <form class="d-flex pb-1" method="POST">
                    <input class="form-control" type="search" placeholder="Buscar Nombre y apellido" aria-label="Buscar" name="nombres">
                    <button class="btn btn-success ms-1" type="submit">Buscar</button>
                </form>
            </div>
            <div class="col">
                <form class="d-flex pb-1" method="POST">
                    <input class="form-control" type="search" placeholder="Buscar Sedes" aria-label="Buscar" name="sede">
                    <button class="btn btn-success ms-1" type="submit">Buscar</button>
                </form>
            </div>
            <div class="col">
                <form class="d-flex mb-3 pb-1 " method="POST">
                    <input class="form-control" type="search" placeholder="Buscar Carreras" aria-label="Buscar" name="carrera">
                    <button class="btn btn-success ms-1" type="submit">Buscar</button>
                </form>
            </div>
        </div>

        <div class="row" hidden>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
        </div>

        <div class="row">
            <div class="row justify-content-md-center">

                <table class="table table-success table-striped table-hover table-bordered border-primary ">

                    <tr>
                        <th>Nro Documento</th>
                        <th>Rut</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Sede</th>
                        <th>Carrera</th>
                    </tr>
                    <?php
                    var_dump($this->datos);

                    ?>
                </table>
            </div>
        </div>
    </div>

</div>


<?php
require "views/includes/footer.template.php";
?>