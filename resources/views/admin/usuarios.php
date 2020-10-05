<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Usuarios</title>
</head>
<body>
<div class="container-fluid mb-lg-5">
    <?php import('admin/components/navbar'); ?>
    <?php import('admin/components/header'); ?>

    <div class="row col-12 d-flex justify-content-center estadisticas mt-5">
        <div>
            <a href="usuarios?action=crear" class="btn btn-primary">Agregar</a>
            <a href="usuarios?action=listar" class="btn btn-success">Lista</a>
        </div>

    </div>
    <?php if( isset($action)  AND $action !== 'listar') :?>
    <h1  class="titulo"><?= $action ?> Usuarios</h1>
    <?php if (isset($errors)):?>
        <div>
            Existen errores, por favor revise.
            Para más detalles ver la variable $erroes
        </div>
    <?php endif;?>
    <div class="row mt-3">
        <div class="col-md-6 offset-3">
            <form action="usuarios" method="POST">
                <?php if ($action == 'editar'): ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= $usuario->id ?>">
                <?php endif;?>
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user icon"></i>
                            </div>
                        </div>
                        <input type="text" placeholder="Nombre:" name="nombre" id="nombre" class="form-control" value=<?= $usuario->nombre ?> >
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user icon"></i>
                            </div>
                        </div>
                        <input type="text" placeholder="Apellido" id="apellido" name="apellido" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user icon"></i>
                            </div>
                        </div>
                        <input type="text" placeholder="Cargo" id="cargo" name="cargo" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-envelope icon"></i>
                            </div>
                        </div>
                        <input type="text" placeholder="Correo Electronico" id="email" name="email" class="form-control" value=<?= $usuario->email ?>>
                    </div>
                </div>
                <?php if ($action == 'crear'): ?>
                <div class="form-group">

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-key icon"></i>
                            </div>
                        </div>
                        <input type="password" placeholder="Contraseña" id="pass" name="pass" class="form-control">
                    </div>
                </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-key icon"></i>
                                    </div>
                                </div>
                                <input type="password" placeholder="Repetir Contraseña" id="rpass" name="rpass" class="form-control">
                            </div>
                        </div>
                    </div>
                <?php endif;?>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block"  style="text-transform: capitalize;">
                        <?= $action ?> el Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php else: ?>

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
                        <td><?php echo $key+1?></td>
                        <td><?php echo $usuario['nombre']?></td>
                        <td><?php echo $usuario['email']?></td>
                        <td><?php echo $usuario['status']?></td>
                        <td><a href="usuarios?action=editar&id=<?= $usuario['id']?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
                        <td>
                            <form action="usuarios" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?=$usuario['id']?>">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-eraser"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>

                </tbody>
            </table>
        </div>
    <?php endif;?>

</div>

<!--footer class="row fixed-bottom d-flex  justify-content-center">
    <h1>Sistema de Administración Trapeca © 2020 </h1>
</footer-->
<script type="text/javascript" src="<?= assets("/js/jquery.min.js"); ?>"></script>
<script src="<?= assets("/js/bootstrap.min.js"); ?>"></script>
</body>
</html>