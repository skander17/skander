<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Movimientos</title>
</head>
<body>
<div class="container-fluid mb-lg-5">
    <?php import('admin/components/navbar'); ?>
    <?php import('admin/components/header'); ?>

    <div class="row col-12 d-flex justify-content-center estadisticas mt-5">
        <div>
            <a href="movimientos?action=crear" class="btn btn-primary">Agregar</a>
            <a href="movimientos?action=listar" class="btn btn-success">Lista</a>
        </div>

    </div>
    <?php if( isset($action)  AND $action !== 'listar') :?>
        <h1  class="titulo"><?= $action ?> Movimientos</h1>
        <div class="row mt-3">
            <div class="col-md-6 offset-3">
                <?php if (isset($errors)):?>
                    <?php foreach ($errors as $error): ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$error?>
                        </div>
                    <?php endforeach; ?>
                <?php endif;?>
                <form action="movimientos" method="POST">
                    <?php if (!empty($movimiento->id_movimiento)): ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id_movimiento" value="<?= $movimiento->id_movimiento ?>">
                    <?php endif;?>
                    <?php if (!empty($movimiento->id_producto)): ?>
                        <input type="hidden" name="id_producto" value="<?= $movimiento->id_producto ?>">
                    <?php endif;?>
                    <div class="form-group">
                        <label for="nombre_prod" class="col-form-label ">Nombre Producto: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-box icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Nombre" name="nombre_prod" id="nombre_prod" class="form-control" value=<?= $movimiento->nombre_prod ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="precio_v" class="col-form-label ">Precio Venta de Producto: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign icon"></i>
                                </div>
                            </div>
                            <input type="number" placeholder="Precio Venta" id="precio_v" name="precio_v" class="form-control" value=<?= $movimiento->precio_v ?? 0 ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="precio_c" class="col-form-label ">Precio Compra de Producto: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign icon"></i>
                                </div>
                            </div>
                            <input type="number" placeholder="Precio Compra" id="precio_c" name="precio_c" class="form-control" value=<?= $movimiento->precio_c ?? 0?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="precio_c" class="col-form-label ">Categoría de Producto: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-tag icon"></i>
                                </div>
                            </div>
                            <select class="form-control" id="id_cate" name="id_cate">
                                <option selected value=''>Categoría...</option>
                                <?php foreach ($categorias as $categoria):?>
                                    <?php if (isset($movimiento->id_cate) AND $movimiento->id_cate == $categoria['id']) : ?>
                                        <option selected value="<?=$categoria['id'] ?>"> <?=$categoria['nombre_cate'] ?></option>
                                    <?php else:?>
                                        <option value="<?=$categoria['id'] ?>"> <?=$categoria['nombre_cate'] ?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo" class="col-form-label ">Tipo de Operación: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-arrows-alt-h icon"></i>
                                </div>
                            </div>
                            <select class="form-control" id="tipo" name="tipo">
                                <option selected value=''>Tipo...</option>
                                <?php foreach ($tipos as $tipo):?>
                                    <?php if (isset($movimiento->tipo) AND $movimiento->tipo == $tipo['id_tipo']) : ?>
                                        <option selected value="<?=$tipo['id_tipo'] ?>"> <?=$tipo['nombre_tipo'] ?></option>
                                    <?php else:?>
                                        <option value="<?=$tipo['id_tipo'] ?>"> <?=$tipo['nombre_tipo'] ?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cantidad" class="col-form-label ">Cantidad de Unidades: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes icon"></i>
                                </div>
                            </div>
                            <input type="number" placeholder="Cantidad" name="cantidad" id="cantidad" class="form-control" value=<?= $movimiento->cantidad ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"  style="text-transform: capitalize;">
                            <?= $action ?> el Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>

        <h1 class="text-center titulo" >Lista de Movimientos</h1>

        <div class="row">
            <div class="col-10 offset-1">
                <table class="tabla mb-5">
                    <thead class="thead">
                    <tr>
                        <th>#</th>
                        <th>Nombre Producto</th>
                        <th>Precio Venta</th>
                        <th>Precio Compra</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Total en Stock</th>
                        <th>Tipo de Movimiento</th>
                        <th>Registrador</th>
                        <th>Modificar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($movimientos as $key => $movimiento):?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $movimiento['nombre_prod']?></td>
                            <td><?php echo $movimiento['precio_v']?></td>
                            <td><?php echo $movimiento['precio_c']?></td>
                            <td><?php echo $movimiento['nombre_cate']?></td>
                            <td><?php echo $movimiento['cantidad_movimiento']?></td>
                            <td><?php echo $movimiento['inventario_cantidad']?></td>
                            <td><?php echo $movimiento['nombre_tipo']?></td>
                            <td><?php echo $movimiento['nombre_usuario']?></td>
                            <td><a href="movimientos?action=editar&id_movimiento=<?php echo $movimiento['id_movimiento'] ?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
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