<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">

    <title>Error 404</title>
</head>

<body class="100-vh">
    <div class="text-center m-5">

        <fieldset>
            <h1 style="color:red;">Error: <?php echo $this->datos["tipo"]; ?></h1>
            <p style="color:red;"><?php
                                    // Plaintext password entered by the user
                                    echo $this->datos["error"];
                                    ?></p>
            <div class="d-grid gap-2 col-3 mx-auto">
                <a class="btn btn-primary" href="/">Volver a inicio</a>
            </div>
            <hr>
        </fieldset>
    </div>
</body>

</html>