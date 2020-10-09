<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Proveedores</title>
</head>
<body>
<script type="text/javascript" src="<?= assets("/js/jquery.min.js"); ?>"></script>

<!--footer class="row fixed-bottom d-flex  justify-content-center">
    <h1>Sistema de Administración Trapeca © 2020 </h1>
</footer-->
<div class="container-fluid mb-lg-5">
    <?php import('admin/components/navbar'); ?>
    <?php import('admin/components/header'); ?>

    <div class="row col-12 d-flex justify-content-center estadisticas mt-5">
        <div class="row col-12 d-flex justify-content-center mt-5">
            <a href="proveedores?action=crear" class="mx-2">
                <button class="btn btn-success  btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Agregar Usuario">
                    <i class="fas fa-plus-circle "></i>
                </button>
            </a>
            <a href="proveedores?action=listar"  class="mx-2">
                <button class="btn btn-info btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Listar">
                    <i class="fas fa-list"></i>
                </button>
            </a>
            <a href="reportes/proveedores" target="_blank"  class="mx-2">
                <button class="btn btn-danger  btn-lg"
                        data-toggle="tooltip" data-placement="bottom" title="Exportar">
                    <i class="fas fa-file-pdf "></i>
                </button>
            </a>
        </div>
    </div>
    <h1  class="titulo">
        <?php if( isset($action)  AND $action !== 'listar') :?>
            <?=  $action ?> Proveedor
        <?php else: ?>
            Lista de Proveedores
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
                <form action="proveedores" method="POST">
                    <?php if ($action == 'editar'): ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $proveedor->id ?>">
                    <?php endif;?>
                    <div class="form-group">
                        <label for="razon_social">Razon Social</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-store icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Razon Social" name="razon_social" id="razon_social" class="form-control" value=<?= $proveedor->razon_social ?> >
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
                            <input type="text" placeholder="Telefono" id="telefono" name="telefono" class="form-control" value=<?= $proveedor->telefono ?> >
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
                            <input type="text" placeholder="Correo Electronico" id="correo" name="correo" class="form-control" value=<?= $proveedor->correo ?>>
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
                            <input type="text" placeholder="Dirección" id="direccion" name="direccion" class="form-control" value=<?= $proveedor->direccion ?>>
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
                            <input type="text" placeholder="DNI" id="dni" name="dni" class="form-control" value=<?= $proveedor->dni ?>>
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
                        <th>Razon Social</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>DNI</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($proveedores as $key => $proveedor):?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $proveedor['razon_social']?></td>
                            <td><?php echo $proveedor['direccion']?></td>
                            <td><?php echo $proveedor['correo']?></td>
                            <td><?php echo $proveedor['telefono']?></td>
                            <td><?php echo $proveedor['dni']?></td>
                            <td><a href="proveedores?action=editar&id=<?= $proveedor['id']?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="proveedores" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?=$proveedor['id']?>">
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