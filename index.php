<?php
  session_start();
  if (!isset($_SESSION['usuario'])) {
    echo'
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Creador-Notas</title>
      <link rel="stylesheet" href="css/style_login.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" charset="utf-8"></script>
      <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <body>
      <div class="content">
        <form class="form" action="php/login.php" method="post">
          <div class="content_input">
            <label class="labelusuario" for="usuario">Usuario</label>
            <input id="usuario" class="input_usuario" type="text" name="usuario" required/>
          </div>
          <div class="content_input">
            <label class="labelpassword" for="password">Contraseña</label>
            <input id="password" class="input_pass" type="password" name="password" required/>
          </div>
          <input class="input_submit" type="submit" name="btn_enviar"/>
        </form>
      </div>
      <script type="text/javascript">
        $( "#password" ).focus(function() {
          $("label.labelpassword").css({"top":"0px"});
        });

        $( "#usuario" ).focus(function() {
          $("label.labelusuario").css({"top":"0px"});
        });
        /*
        $( "#password" ).focusout(function() {
          $("label.labelpassword").css({"top":"20px"});
        });

        $( "#usuario" ).focusout(function() {
          $("label.labelusuario").css({"top":"20px"});
        });
        */



      </script>
    </body>
    </html>
    ';
  }else{
    header('Location: ./principal.php');
  }

?>
