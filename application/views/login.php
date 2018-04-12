<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?= base_url() ?>css/login/style.css">


</head>

<body>
    <div class="pen-title">
        <!--<h1>CUERPO DE BOMBEROS DEL CANTÓN BALZAR</h1><span>Pen <i class='fa fa-code'></i> by <a href='http://aleverarise.com.ve/'>AleVerArise</a></span>-->
        <h1>CUERPO DE BOMBEROS DEL CANTÓN BALZAR</h1>
    </div>
    <div class="container">
        <div class="card"></div>
        <div class="card">
            <h1 class="title">Login <h4 style="color:red"><?= $this->session->flashdata('UserNoActivated'); ?></h4></h1>
            <form action="panel/SuccessLogin" method="POST">
                <div class="input-container">
                    <input type="#{type}" id="#{label}" required="required" name="usuario" autocomplete="off" />
                    <label for="#{label}">
                        <span style="color:red">* </span>Usuario 
                        <h4 style="color:red"><?= $this->session->flashdata('NoExistUsuario'); ?></h4>
                    </label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="password" id="#{label}" required="required" name="clave" autocomplete="off" />
                    <label for="#{label}"><span style="color:red">* </span>Contraseña
                        <h4 style="color:red"><?= $this->session->flashdata('NoExistClave'); ?></h4>
                    </label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button type="submit"><span>Entrar</span></button>
                </div>
            </form>
        </div>
        <div class="card alt">
            <a href="<?= base_url(); ?>web"><div class="toggle"><i class="fa fa-medkit" aria-hidden="true"></i></div></a>
        </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="<?= base_url() ?>js/login/index.js"></script>

</body>
</html>
