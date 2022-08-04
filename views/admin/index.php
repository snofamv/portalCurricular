<?php
require "views/includes/navbar.admin.php";

?>

<!-- CONTENIDO DE LA VISTA -->
<div class="container mx-auto mt-3 mb-5 text-center">
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


    <div class="row gap-5 m-0 p-0">
        <div class="col rounded pt-2">
            <div class="card mx-auto shadow p-2" style="width: 370px; height: 400px; background-color: #8CC0DE;">
                <img src="https://www.svgrepo.com/show/125846/graduate.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Alumnos</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/lista" class="btn btn-primary btn-lg">Ver listado alumnos</a>
                </div>
            </div>
        </div>
        <div class="col rounded p-2">
            <div class="card mx-auto shadow p-2" style="width: 370px; height: 400px; background-color: #8CC0DE;">
                <img src="https://www.svgrepo.com/show/286737/update-repeat.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Actualizar informacion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Actualizar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color: #A5BECC;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar informacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body mx-auto">
                                    <p><span class="fs-4">Seleccionar metodo de busqueda</span></p>

                                </div>
                                <div class="modal-footer mx-auto">
                                    <a type="button" class="btn btn-warning" href="/lista">Buscar RUT/Nombre/Codigo</a>
                                    <a type="button" class="btn btn-warning" href="/buscar">Buscar Sedes/Carreras</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col rounded p-2">
            <div class="card mx-auto shadow p-2" style="width: 370px; height: 400px; background-color: #8CC0DE;">
                <img src="https://www.svgrepo.com/show/216744/add.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Agregar informacion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/agregar" class="btn btn-primary btn-lg">Agregar</a>
                </div>
            </div>
        </div>



        <div class="col rounded p-2">
            <div class="card mx-auto shadow p-2" style="width: 370px; height: 400px; background-color: #8CC0DE;">
                <img src="https://www.svgrepo.com/show/303651/google-cloud-logo.svg" class="card-img-top mx-auto mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Buscar archivos</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/storage" class="btn btn-success btn-lg">Ir a Storage</a>
                </div>
            </div>
        </div>
        <div class="col rounded p-2">
            <div class="card mx-auto shadow p-2" style="width: 370px; height: 400px; background-color: #8CC0DE;">
                <img src="https://www.svgrepo.com/show/112621/pdf.svg" class="card-img-top mx-auto mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Exportar PDF</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/pdf" class="btn btn-danger btn-lg">Ir a PDF</a>
                </div>
            </div>
        </div>
        <div class="col rounded p-2">
            <div class="card mx-auto shadow p-2" style="width: 370px; height: 400px; background-color: #8CC0DE;">
                <img src="https://www.svgrepo.com/show/207527/settings-configuration.svg" class="card-img-top mx-auto mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Opciones</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/admin/opciones" class="btn btn-secondary btn-lg">Ver mas operaciones</a>
                </div>
            </div>
        </div>

        <div class="col rounded p-2">
            <div class="card mx-auto shadow p-2" style="width: 370px; height: 400px; background-color: #8CC0DE;">
                <img src="https://www.svgrepo.com/show/94002/logout.svg" class="card-img-top ms-5" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Cerrar sesion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/admin/salir" class="btn btn-danger btn-lg  ">Cerrar sesion</a>
                </div>
            </div>
        </div>



    </div>

</div>

<?php
require "views/includes/footer.template.php";
?>