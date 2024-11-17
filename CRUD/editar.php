<?php
include "conexion.php";

 $id =$_GET["id"];

 $sql=$conexion->query("select*from usuarios where id=$id");
 



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>

      .col-4{


        position: relative;
            top: 200px;
            right: 50px;
            margin: 10px;
            transform: translate(50px, 20px);

      }

    </style>
</head>

<body>
    <form class="col-4 m-auto" method="post">
        <h3 class="alert alert-success m-auto">EDITAR USUARIO</h3>
        <input type="hidden" name="id" value="<?= $_GET["id"]?>">
       <?php
        while ($datos = $sql->fetch_object()) {
        ?>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre?>">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" value="<?= $datos->correo?>">
            </div>
        <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnregistrar"])) {
            include "editarRegistro.php";
        }
        }
        ?>
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Editar</button>
    </form>
</body>


</html>


