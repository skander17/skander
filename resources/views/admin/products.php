<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Productos</title>
</head>
<body>
<div class="container-fluid mb-lg-5">
    <?php import('admin/components/navbar'); ?>
    <?php import('admin/components/header'); ?>

    <div class="row col-12 d-flex justify-content-center estadisticas mt-5">
        <div>
            <a href="productos?action=crear" class="btn btn-primary">Agregar</a>
            <a href="productos?action=listar" class="btn btn-success">Lista</a>
        </div>

    </div>
    <?php if( isset($action)  AND $action !== 'listar') :?>
        <h1  class="titulo"><?= $action ?> Productos</h1>
        <?php if (isset($errors)):?>
            <div>
                Existen errores, por favor revise.
                Para más detalles ver la variable $erroes
            </div>
        <?php endif;?>
        <div class="row mt-3">
            <div class="col-md-6 offset-3">
                <form action="productos" method="POST">
                    <?php if ($action == 'editar'): ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $producto->id ?>">
                    <?php endif;?>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-box icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Nombre" name="nombre_prod" id="nombre_prod" class="form-control" value=<?= $producto->nombre_prod ?> >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="precio_v" class="col-form-label ">Precio Venta: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Precio Venta" id="precio_v" name="precio_v" class="form-control" value=<?= $producto->precio_v ?? 0 ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="precio_c" class="col-form-label ">Precio Compra: </label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-dollar-sign icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Precio Compra" id="precio_c" name="precio_c" class="form-control" value=<?= $producto->precio_c ?? 0?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-tag icon"></i>
                                </div>
                            </div>
                            <select class="form-control" id="id_cate" name="id_cate">
                                <option selected value=''>Categoría...</option>
                                <?php foreach ($categorias as $categoria):?>
                                    <?php if (isset($producto->id_cate) AND $producto->id_cate == $categoria['id']) : ?>
                                        <option selected value="<?=$categoria['id'] ?>"> <?=$categoria['nombre_cate'] ?></option>
                                    <?php else:?>
                                        <option value="<?=$categoria['id'] ?>"> <?=$categoria['nombre_cate'] ?></option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-check-circle icon"></i>
                                    </div>
                                </div>
                            </div>
                            <input type="checkbox"
                                   class="form-check-input ml-2"
                                   value=<?=$producto->disponible?>
                                   id="disponible" name="disponible"
                                   class="form-control" <?= boolval($producto->disponible) ? "checked" : "" ?>
                            >
                            <label class="form-check-label" for="inlineCheckbox1">Disponible</label>
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

        <h1 class="text-center titulo" >Lista de Productos</h1>

        <div class="row">
            <div class="col-10 offset-1">
                <table class="tabla mb-5">
                    <thead class="thead">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Precio Venta</th>
                        <th>Precio Compra</th>
                        <th>Categoría</th>
                        <th>Disponible</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($productos as $key => $producto):?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $producto['nombre_prod']?></td>
                            <td><?php echo $producto['precio_v']?></td>
                            <td><?php echo $producto['precio_c']?></td>
                            <td><?php echo $producto['nombre_cate']?></td>
                            <td><?php echo boolval($producto['disponible']) ? "Si" :"No"?></td>
                            <td><a href="productos?action=editar&id=<?php echo $producto['id'] ?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="productos" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?php echo $producto['id'] ?>">
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