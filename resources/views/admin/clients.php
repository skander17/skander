<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Clientes</title>
</head>
<body>
<script type="text/javascript" src="<?= assets("/js/jquery.min.js"); ?>"></script>

<!--footer class="row fixed-bottom d-flex  justify-content-center">
    <h1>Sistema de Administración Trapeca © 2020 </h1>
</footer-->
<div class="container-fluid mb-lg-5">
    <?php import('admin/components/navbar'); ?>
    <?php import('admin/components/header'); ?>

    <div class="row col-12 d-flex justify-content-center mt-5">
        <div class="row col-12 d-flex justify-content-center mt-5">
            <a href="clientes?action=crear" class="mx-2">
                <button class="btn btn-success  btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Agregar Usuario">
                    <i class="fas fa-plus-circle "></i>
                </button>
            </a>
            <a href="clientes?action=listar"  class="mx-2">
                <button class="btn btn-info btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Listar">
                    <i class="fas fa-list"></i>
                </button>
            </a>
            <a href="reportes/clientes" target="_blank"  class="mx-2">
                <button class="btn btn-danger  btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Exportar">
                    <i class="fas fa-file-pdf "></i>
                </button>
            </a>
        </div>
    </div>
    <h1  class="titulo">
        <?php if( isset($action)  AND $action !== 'listar') :?>
             <?=  $action ?> Cliente
        <?php else: ?>
            Lista de Clientes
        <?php endif;?>
    </h1>
    <?php if (isset($errors)):?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger row col-4 offset-4 my-2" role="alert">
                <?=$error?>
            </div>
        <?php endforeach; ?>
    <?php endif;?>
    <?php if( isset($action)  AND $action !== 'listar') :?>
        <div class="row mt-3">
            <div class="col-md-6 offset-3">
                <form action="clientes" method="POST">
                    <?php if ($action == 'editar'): ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $cliente->id ?>">
                    <?php endif;?>
                    <div class="form-group">
                        <label for="nombre">Nombre del Cliente</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Nombre:" name="nombre" id="nombre" class="form-control" value=<?= $cliente->nombre ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Apellidos del Cliente</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Apellido" id="apellido" name="apellido" class="form-control" value=<?= $cliente->apellido ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono de contacto</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Telefono" id="telefono" name="telefono" class="form-control" value=<?= $cliente->telefono ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Email de contacto</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Correo Electronico" id="correo" name="correo" class="form-control" value=<?= $cliente->correo ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Dirección</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-map-marked icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Dirección" id="direccion" name="direccion" class="form-control" value=<?= $cliente->direccion ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-address-card icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="DNI" id="dni" name="dni" class="form-control" value=<?= $cliente->dni ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"  style="text-transform: capitalize;">
                            <?= $action ?> el cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-10 offset-1">
                <table class="tabla mb-5">
                    <thead class="thead">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($clientes as $key => $cliente):?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $cliente['nombre']?></td>
                            <td><?php echo $cliente['apellido']?></td>
                            <td><?php echo $cliente['direccion']?></td>
                            <td><?php echo $cliente['correo']?></td>
                            <td><a href="clientes?action=editar&id=<?= $cliente['id']?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="clientes" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?=$cliente['id']?>">
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
<script src="<?= assets("/js/bootstrap.min.js"); ?>"></script>
</body>
</html>