<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Usuarios</title>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-top color-nav d-flex justify-content-center">
        <ul class="nav d-nav text-white d-flex justify-content-center">
            <li class="nav-item">
                <a href="/admin/dashboard" class="nav-link">
                    Estadisticas
                </a>
            </li>
            <li class="nav-item">
                <a href="clientes.php" class="nav-link active">
                    Clientes
                </a>
            </li>

            <li class="nav-item">
                <a href="proveedores.php" class="nav-link">
                    Proveedores
                </a>
            </li>
            <li class="nav-item">
                <a href="mercancias.php" class="nav-link">
                    Mercancias
                </a>
            </li>
            <li class="nav-item">
                <a href="entradas.php" class="nav-link">
                    Compras Realizadas
                </a>
            </li>
            <li class="nav-item">
                <a href="salidas.php" class="nav-link">
                    Ventas Realizadas
                </a>
            </li>
            <li class="nav-item">
                <a href="/admin/usuarios" class="nav-link">
                    Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a href="/logout" class="nav-link">
                    Cerrar Sesión
                </a>
            </li>
        </ul>
    </nav>
    <div class="row">
        <div class="col-12 text-center welcome d-flex justify-content-center flex-wrap align-items-end">
            <h2 class="w-100">Sistema de Administracion Trapeca</h2>
            <p class="w-100">
                Sistema de Inventario Negro2000, sistema utilizado para el manejo de inventario, asi como la entrada y salida de la mercancia.
            </p>
        </div>
    </div>

    <div class="row col-12 d-flex justify-content-center estadisticas mt-5">
        <div>
            <a href="mantenimiento/usuario/usuario_agregar.php" class="btn btn-primary">Agregar</a>
            <a href="" class="btn btn-success">Lista</a>
        </div>

    </div>

    <h1 class="text-center titulo" >Lista de usuarios</h1>

    <div class="row">
        <table class="tabla mb-5">
            <thead class="thead">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($usuarios as $key => $usuario):?>
                <tr>
                    <td><?php echo $key++?></td>
                    <td><?php echo $usuario['nombre']?></td>
                    <td><?php echo $usuario['email']?></td>
                    <td><?php echo $usuario['status']?></td>
                    <td><a href="mantenimiento/usuario/usuario_modificar.php?id=<?php echo $usuario['id']?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
                    <td><a href="mantenimiento/usuario/usuario_eliminar.php?id=<?php echo $usuario['id']?>"class="btn btn-danger"> <i class="fas fa-eraser"></i></a></td>
                </tr>
            <?php endforeach;?>

            </tbody>
        </table>
    </div>
    <footer class="row d-flex  justify-content-center">
        <h1>Sistema de Administración Trapeca © 2020 </h1>
    </footer>
</div>


<footer class="row d-flex  justify-content-center">
    <h1>Sistema de Administración Trapeca © 2020 </h1>
</footer>
</div>

</body>
</html>