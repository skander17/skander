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
        <a href="monedas?action=crear" class="mx-2">
            <button class="btn btn-success  btn-lg"
                    data-toggle="tooltip" data-placement="bottom" title="Agregar Usuario">
                <i class="fas fa-plus-circle "></i>
            </button>
        </a>
        <a href="monedas?action=listar"  class="mx-2">
            <button class="btn btn-info btn-lg"
                    data-toggle="tooltip" data-placement="bottom" title="Listar">
                <i class="fas fa-list"></i>
            </button>
        </a>
        <a href="reportes/monedas" target="_blank"  class="mx-2">
            <button class="btn btn-danger  btn-lg"
                    data-toggle="tooltip" data-placement="bottom" title="Exportar">
                <i class="fas fa-file-pdf "></i>
            </button>
        </a>
    </div>
    <?php if( isset($action)  AND $action !== 'listar') :?>
        <h1  class="titulo"><?= $action ?> Monedas</h1>
        <?php if (isset($errors)):?>
            <div>
                Existen errores, por favor revise.
                Para más detalles ver la variable $erroes
            </div>
        <?php endif;?>
        <div class="row mt-3">
            <div class="col-md-6 offset-3">
                <form action="monedas" method="POST">
                    <?php if ($action == 'editar'): ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $moneda->id_monedas ?>">
                    <?php endif;?>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Nombre:" name="nombre" id="nombre" class="form-control" value=<?= $moneda->nombre ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Simbolo" id="simbolo" name="simbolo" class="form-control" value=<?= $moneda->simbolo ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-divide icon"></i>
                                </div>
                            </div>
                            <input type="number" placeholder="Tasa de Cambio" id="tasa_cambio" name="tasa_cambio" class="form-control" value=<?= $moneda->tasa_cambio ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"  style="text-transform: capitalize;">
                            <?= $action ?> la Modena
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>

        <h1 class="text-center titulo" >Lista de Monedas</h1>
        <div class="row">
            <div class="col-10 offset-1">
                <table class="tabla mb-5">
                    <thead class="thead">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Simbolo</th>
                        <th>Tasa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($monedas as $key => $moneda):?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $moneda['nombre']?></td>
                            <td><?php echo $moneda['simbolo']?></td>
                            <td><?php echo $moneda['tasa_cambio']?></td>
                            <td><a href="monedas?action=editar&id=<?= $moneda['id_monedas']?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="monedas" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?=$moneda['id_monedas']?>">
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
<script src="<?= assets("/js/bootstrap.min.js"); ?>"></script>
</body>
</html>