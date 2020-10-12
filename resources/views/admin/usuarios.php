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

    <div class="row col-12 d-flex justify-content-center mt-5">
            <a href="usuarios?action=crear" class="mx-2">
                <button class="btn btn-success  btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Agregar Usuario">
                    <i class="fas fa-plus-circle "></i>
                </button>
            </a>
            <a href="usuarios?action=listar"  class="mx-2">
                <button class="btn btn-info btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Listar">
                    <i class="fas fa-list"></i>
                </button>
            </a>
            <a href="reportes/usuarios" target="_blank"  class="mx-2">
                <button class="btn btn-danger  btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Exportar">
                    <i class="fas fa-file-pdf "></i>
                </button>
            </a>
    </div>
    <?php if( isset($action)  AND $action !== 'listar') :?>
    <h1  class="titulo"><?= $action ?> Usuarios</h1>
    <div class="row mt-3">
        <div class="col-md-6 offset-3">
            <?php if (isset($errors)):?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?=$error?>
                    </div>
                <?php endforeach; ?>
            <?php endif;?>
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
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-key icon"></i>
                            </div>
                        </div>
                        <select class="form-control" id="rol" name="rol">
                            <?php foreach ($roles as $rol):?>
                                <?php if (isset($usuario->rol) AND $usuario->rol == $rol['id']) : ?>
                                    <option selected value="<?=$rol['id'] ?>"> <?=$rol['nombre'] ?></option>
                                <?php else:?>
                                    <option value="<?=$rol['id'] ?>"> <?=$rol['nombre'] ?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
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
                        <input type="password" placeholder="Contraseña" id="password" name="password" class="form-control">
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
            <div class="col-10 offset-1">
                <table class="tabla mb-5">
                <thead class="thead">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Activar/Bloquear</th>
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
                            <td><?php echo $usuario['status'] ==1 ? "Activo":"Bloqueado" ;?></td>
                            <td><?php echo $usuario['rol_nombre']?></td>
                            <td>
                                <form action="usuarios" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" value="<?=$usuario['id']?>">
                                    <?php if ($usuario['status'] == 1):?>
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-danger"
                                                data-toggle="tooltip" data-placement="bottom" title="Bloquear">
                                            <i class="fas fa-user-lock"></i>
                                        </button>
                                    <?php else:?>
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-success"
                                                data-toggle="tooltip" data-placement="bottom" title="Activar">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                    <?php endif;?>
                                </form>
                            </td>
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
        </div>
    <?php endif;?>

</div>

<!--footer class="row fixed-bottom d-flex  justify-content-center">
    <h1>Sistema de Administración Trapeca © 2020 </h1>
</footer-->
<script type="text/javascript" src="<?= assets("/js/jquery.min.js"); ?>"></script>
<script src="<?= assets("/js/bootstrap.bundle.min.js"); ?>"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>