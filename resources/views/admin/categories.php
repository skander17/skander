<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Categorias</title>
</head>
<body>
<div class="container-fluid mb-lg-5">
    <?php import('admin/components/navbar'); ?>
    <?php import('admin/components/header'); ?>

    <div class="row col-12 d-flex justify-content-center estadisticas mt-5">
        <div>
            <a href="categorias?action=crear" class="btn btn-primary">Agregar</a>
            <a href="categorias?action=listar" class="btn btn-success">Lista</a>
        </div>

    </div>
    <?php if( isset($action)  AND $action !== 'listar') :?>
        <h1  class="titulo"><?= $action ?> Categorias</h1>
        <?php if (isset($errors)):?>
            <div>
                Existen errores, por favor revise.
                Para más detalles ver la variable $erroes
            </div>
        <?php endif;?>
        <div class="row mt-3">
            <div class="col-md-6 offset-3">
                <form action="categorias" method="POST">
                    <?php if ($action == 'editar'): ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $categoria->id ?>">
                    <?php endif;?>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-tag icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Nombre" name="nombre_cate" id="nombre_cate" class="form-control" value=<?= $categoria->nombre_cate ?> >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-barcode icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Codigo Categoría" id="code_cate" name="code_cate" class="form-control" value=<?= $categoria->code_cate?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-comment icon"></i>
                                </div>
                            </div>
                            <input type="text" placeholder="Descripción Categoría" id="descripcion_cate" name="descripcion_cate" class="form-control" value=<?= $categoria->descripcion_cate?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"  style="text-transform: capitalize;">
                            <?= $action ?> el Categoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>

        <h1 class="text-center titulo" >Lista de Categorias</h1>

        <div class="row">
            <div class="col-10 offset-1">
                <table class="tabla mb-5">
                    <thead class="thead">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($categorias as $key => $categoria):?>
                        <tr>
                            <td><?php echo $key+1?></td>
                            <td><?php echo $categoria['nombre_cate']?></td>
                            <td><?php echo $categoria['code_cate']?></td>
                            <td><?php echo $categoria['descripcion_cate']?></td>
                            <td><a href="categorias?action=editar&id=<?php echo $categoria['id'] ?>" class="btn btn-warning"> <i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="categorias" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?php echo $categoria['id'] ?>">
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