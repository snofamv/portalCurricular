<?php
require "views/includes/navbar.admin.php";
#D is a data global variable;
?>
<!-- Tabla de datos -->
<div class="container-fluid">

    <div class="row align-items-center p-4">

        <div class="col">
            <div class="card text-center mx-auto shadow p-3 mb-5 bg-body rounded" style="width: 22rem;">
                <img src="https://www.svgrepo.com/show/128306/graduate.svg" height="250px;" class="card-img-top" alt="carta alumno<?php echo " {$d->getNombres()} {$d->getApellidos()}"; ?>">
                <div class="card-body">
                    <h5 class="card-title"><span><?php echo $d->getNombres() ." ".$d->getApellidos();?></h5>
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
                <div class="m-3">
                    <form action="<?php echo URLBASE;?>/eliminar/eliminarAlumno" method="post">
                        <input type="text" name="rutEliminar" id="rutEliminar" value="<?php echo $d->getRut(); ?>" hidden>
                        <input class="btn btn-danger" type="submit" value="Eliminar" name="btnEliminarAlumno" style="width: 300px; height: 50px;">
                    </form>
                </div>
            </div>
        </div>


    </div>


</div>
<?php
require "views/includes/footer.template.php";
?>