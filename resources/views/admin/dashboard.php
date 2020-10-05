<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes initial-scale=1.0 maximum-scale=3.0 minium-scale=1.0">
    <link rel="stylesheet"  href="<?= assets("/icons/css/all.min.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/estilos.css"); ?>">
    <link rel="stylesheet"  href="<?= assets("/css/bootstrap.min.css"); ?>">
    <title>Inicio</title>
</head>
<body>
<div class="container-fluid">
    <?php import('admin/components/navbar'); ?>

    <div class="row">
        <div class="col-12 text-center welcome d-flex justify-content-center flex-wrap align-items-end">
            <h2 class="w-100">Sistema de Administracion Trapeca</h2>
            <p class="w-100">
                Sistema utilizado para el manejo de inventario, asi como la entrada y salida de la mercancia.
            </p>
        </div>
    </div>

    <div class="row col-12 d-flex justify-content-center estadisticas mt-5">
        <div class="col-6 d-flex justify-content-center mt-3 flex-wrap ">
            <div class="caja-estadisticas d-flex col-5 mr-1">
                <div class="icono"><i class="fas fa-truck"></i></div>
                <div class="texto">
                    <h3>Proveedores</h3>
                    <h6><?php echo $proveedor?></h6>
                </div>
            </div>
            <div class="caja-estadisticas d-flex col-5">
                <div class="icono"><i class="fas fa-user-tie"></i></div>
                <div class="texto">
                    <h3>Clientes</h3>
                    <h6><?php echo $clientes?></h6></div>
            </div>
            <div class="caja-estadisticas d-flex col-5 mt-3 mr-1">
                <div class="icono"><i class="fas fa-boxes"></i></div>
                <div class="texto">
                    <h3>Inventario</h3>
                    <h6><?php echo $mercancia?></h6></div>
            </div>
            <div class="caja-estadisticas d-flex col-5 mt-3">
                <div class="icono"><i class="fas fa-cart-plus"></i></div>
                <div class="texto">
                    <h3>Ventas</h3>
                    <h6><?php echo $ventas?></h6></div>
            </div>
            <div class="caja-estadisticas d-flex col-5 mr-1">
                <div class="icono"><i class="fas fa-dollar-sign"></i></div>
                <div class="texto">
                    <h3>Compras</h3>
                    <h6><?php echo $compras?></h6>
                </div>
            </div>
            <div class="caja-estadisticas d-flex col-5 mr-1">
                <div class="icono"><i class=" fas fa-users"></i></div>
                <div class="texto">
                    <h3>Usuarios</h3>
                    <h6><?php echo $usuarios?></h6>
                </div>
            </div>
        </div>
    </div>


    <footer class="row d-flex  justify-content-center">
        <h1>Sistema de Administración Trapeca © 2020 </h1>
    </footer>
</div>




<script type="text/javascript" src="<?= assets("/js/jquery.min.js"); ?>"></script>
<script type="text/javascript" src="<?= assets("/js/bootstrap.min.js"); ?>"></script>
</body>
</html>