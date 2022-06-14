<?php
require "views/includes/navbar.admin.php";
?>

<!-- CONTENIDO DE LA VISTA -->
<div class="container mx-auto mb-5 mt-5 ">

    <div class="row gap-5">
        <div class="col shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card mb-2" style="width: 370px; max-height: 380px;">
                <img src="https://www.svgrepo.com/show/125846/graduate.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Alumnos</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/lista" class="btn btn-secondary btn-lg  ">Ver listado alumnos</a>
                </div>
            </div>
        </div>
        <div class="col shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card mb-2" style=" width: 370px; max-height: 380px;">
                <img src="https://www.svgrepo.com/show/3907/search.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Buscar informacion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">
                    <a href="/buscar" class="btn btn-primary btn-lg  ">Buscar</a>
                </div>
            </div>
        </div>
        <div class="col shadow-lg p-3 mb-5 bg-body rounded ">
            <div class="card mb-2" style="width: 370px; max-height: 380px;">
                <img src="https://www.svgrepo.com/show/216744/add.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Agregar informacion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/agregar" class="btn btn-success btn-lg  ">Agregar</a>
                </div>
            </div>
        </div>

        <div class="col shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card mb-2" style="width: 370px; max-height: 380px;">
                <img src="https://www.svgrepo.com/show/286737/update-repeat.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Actualizar informacion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/actualizar" class="btn btn-secondary btn-lg  ">Actualizar</a>
                </div>
            </div>
        </div>
        <div class="col shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card mb-2" style="width: 370px; max-height: 380px;">
                <img src="https://www.svgrepo.com/show/199940/delete.svg" class="card-img-top mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Eliminar informacion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="/eliminar" class="btn btn-danger btn-lg  ">Eliminar datos</a>
                </div>
            </div>
        </div>

        <div class="col shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card mb-2" style="width: 370px; max-height: 380px;">
                <img src="https://www.svgrepo.com/show/120612/panel.svg" class="card-img-top mx-auto mx-auto" alt="..." style="max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Panel de administracion</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <div class="d-grid">

                    <a href="#" class="btn btn-warning btn-lg  ">Panel de administracion</a>
                </div>
            </div>
        </div>




    </div>


    <?php
    require "views/includes/footer.template.php";
    ?>