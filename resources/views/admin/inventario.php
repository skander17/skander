<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Inventario</title>
</head>
<body>
<div class="container-fluid mb-lg-5">
    <?php import('admin/components/navbar'); ?>
    <?php import('admin/components/header'); ?>
</div>
<h1 class="text-center titulo" >Productos en Stock</h1>

<div class="row">

    <div class="col-md-10 offset-1">
        <table id="inventario"  class="mb-5 table" style="width:100%">
             <thead class="thead">
                <tr>
                <th>#</th>
                    <th>Nombre</th>
                    <th>Precio Venta</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Disponible</th>
                    <th>Cargar</th>
                </tr>
                </thead>
                    <tbody>
                    <?php foreach($productos as $key => $producto):?>
                        <tr>
                        <td><?php echo $key+1?></td>
                            <td><?php echo $producto['nombre_prod']?></td>
                            <td><?php echo $producto['precio_v']?></td>
                            <td><?php echo $producto['nombre_cate']?></td>
                            <td><?php echo $producto['cantidad']?></td>
                            <td><?php echo boolval($producto['disponible']) ? "Si" :"No"?></td>
                            <td><a href="movimientos?action=crear&producto_id=<?php echo $producto['id_producto'] ?>" class="btn btn-warning"> <i class="fas fa-upload"></i></a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
        </table>
    </div>
</div>
<!--footer class="row fixed-bottom d-flex  justify-content-center">
    <h1>Sistema de Administración Trapeca © 2020 </h1>
</footer-->
<script type="text/javascript" src="<?= assets("/js/jquery.min.js"); ?>"></script>
<script src="<?= assets("/js/bootstrap.min.js"); ?>"></script>
</body>
</html>