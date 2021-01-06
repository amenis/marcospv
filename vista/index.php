<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <title>Inicio</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo urlsite; ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo urlsite; ?>vista/css/login.css">
  <!--<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">-->

</head>

<body style="overflow:hidden ">
  <section class="login-block">
    <div class="container">
      <div class="row">
        <div class="col-md-4 login-sec">
          <h2 class="text-center">Iniciar Sesión</h2>
          <div class="">
            <label><i class="fas fa-user-circle"></i> &nbsp;Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre de Usuario" required>
          </div>
          <div class=""><br>
            <label><i class="fas fa-key"></i>&nbsp;Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña"><br>
            <input type="checkbox" onclick="myFunction()">mostrar contraseña
          </div>
          <div class="form-check">
            <button type="submit" id="ingresar" class="btn btn-login float-right">Acceder</button>
          </div>
          <div class="copy-text"> ® 2020 Guadalais</div>
        </div>
        <div class="col-md-8 banner-sec">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" link="" id="bot" value="1" class=""></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="img-responsive center-block" src="assets/imagenes/salepoint.png" alt="First slide" style='margin-left:30%;margin-top:15%;'>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <script src="<?php echo urlsite; ?>assets/bootstrap/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo urlsite; ?>assets/bootstrap/js/popper.min.js"></script>
  <script src="<?php echo urlsite; ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/alertify.css">
  <link rel="stylesheet" href="<?php echo urlsite; ?>assets/alertifyjs/css/themes/bootstrap.css">
  <script src="<?php echo urlsite; ?>assets/alertifyjs/alertify.js"></script>
</body>

<script type="text/javascript">
  $(document).on("click", "#ingresar", function() {
    validaDatos();
  });

  $(document).on('keydown', function(evt) {
    if (evt.keyCode == 13) {
      validaDatos();
    }
  });


  function validaDatos() {

    if ($("#empleados").val() == "") {
      alertify.error('Inserta Un empleado');
      $("#empleado").focus();
    } else if ($("#password").val() == "") {
      alertify.error('Inserta Una contraseña');

      $("#password").focus();
    } else {

      $.ajax({
        type: "POST",
        url: "login/singin/",
        data: ({
          accion: 'login',
          usuario: $("#usuario").val(),
          password: $("#password").val()
        }),
        //dataType: "html",
        async: true,
        success: function(msg) {
          
          if (msg == "correcto") {
            alertify.success('Bienvenido admin');
            window.location.reload();
          } else {
            alertify.error('Error al ingresar');
            $("#usuario").val("");
            $("#contraseña").val("");
            $("#usuario").focus();
            //window.location = "/home/home.php";

          }
        }
      });
    }
  }

  ///mostrar contraseña
  function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>

</html>