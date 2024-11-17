<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexion de My SQL con PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1eedfcb863.js" crossorigin="anonymous"></script>
    <style>
        .container {
            position: relative;
            top: 200px;
            right: -100px;
            margin: 10px;
            transform: translate(50px, 20px);
        }

        .Sirve {
            position: relative;
            top: 400px;
            left: 30px;
            margin: 10px;
            transform: translate(50px, 20px);
        }

        .col-8 {
            position: relative;
            top: -400px;
            left: 500px;
            margin: 10px;
            transform: translate(50px, 20px);
        }
    </style>


</head>

<body>

<script>

function eliminar(){
    var respuesta=confirm("Seguro que desea eliminar el resgitro?");
    return respuesta
}

</script>

    <?php
    include "conexion.php";
    include "eliminar.php";
    

    ?>

    <div class="container">
        <form class="col-4" method="post">
            <h3>REGISTRO USUARIO</h3>

            <?php
         
        include "registro.php";
        
            ?>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ID</label>
                <input type="int" class="form-control" name="id">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo">
            </div>


            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
        </form>

        <div class="col-8 p-4">

            <table class="table">


                <thead>

                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col"></th>
                    </tr>


                </thead>
                <tbody>

                    <?php

                    include "conexion.php";
                    $sql = $conexion->query("select*from usuarios");
                    while ($datos = $sql->fetch_object()) { ?>

                        <tr>
                            <td><?= $datos->id ?></td>
                            <td><?= $datos->nombre ?></td>
                            <td><?= $datos->correo ?></td>
                            <td>
                                <a href="editar.php?id=<?= $datos->id ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a onclick="return eliminar()" href="index.php?id=<?= $datos->id ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>


                    <?php
                    }
                    ?>




                </tbody>

            </table>

        </div>

    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>