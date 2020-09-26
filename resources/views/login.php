<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <meta name="viewport" content="width=device-width, user-scalable=yes initial-scale=1.0 maximum-scale=3.0 minium-scale=1.0">
    <link rel="stylesheet"  href="css/all.min.css">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="login">

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <form class="formulario mt-5 col-6 offset-3 text-center " id="formulario" name="formulario" method="POST" action="<?php echo "/login"; ?>">
                <h1 class="text-center display-4 mb-3 text-white">Iniciar Sesión</h1>
                <?php if(!empty($errores)): ?>
                    <?php echo $errores;?>
                <?php endif; ?>
                <div class="form-group login">
                    <i class="far fa-address-card icon"></i>
                    <input type="text" placeholder="Correo Electronico " id="email" name="email" class="form-control">
                    <span></span>
                </div>

                <div class="form-group login">
                    <i class="fas fa-key icon"></i>
                    <input type="password" placeholder="Contraseña" id="pass" name="pass" class="form-control">
                    <span></span>
                </div>
                <input type="submit" value="Ingresar" class="btn btn-success btn-block mt-5">
            </form>
        </div>
    </div>

</div>
</body>
<script src="js/val_formlogin.js"></script>
</html>