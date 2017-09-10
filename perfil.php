<?php
session_start();
if (isset($_SESSION['usuario'])) {
  echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Creador-Notas</title>
      <link rel="stylesheet" href="css/style_general.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" charset="utf-8"></script>
      <script src="js/script_general.js" charset="utf-8"></script>
        <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <body>
      <div class="content">


        <nav class="menu">
            <div class="content_icon_open_nav">
              <div class="icon_open_nav"onclick="selectButtonMenu();">
                <div class="line_button_open_nav" id="line_1"></div>
                <div class="line_button_open_nav" id="line_2"></div>
                <div class="line_button_open_nav" id="line_3"></div>
              </div>
            </div>
            <ul>
              <!--<li><a class="btn_inicio" href="principal.php">Inicio</a></li>-->
              <li class="user">

                <a href="#"><span>'.$_SESSION['usuario'].'</span><img class="arrow" src="img/arrow_desplegable.png" alt=""></a>
                <ul class="menu_user">
                    <li><a href="perfil.php">Perfil</a></li>
                    <li>
                      <form class="form_logout" action="php/cerrar_sesion.php" method ="post">
                        <input class="btn_logout" type="submit" name="logout" value="Cerrar sesión">
                      </form>
                    </li>
                </ul>
              </li>
            </ul>
          </nav>
          <div class="bloque_opacity" onclick="selectButtonMenu();">

          </div>
          <a href="newNota.php?new" class="content_icon_new_note"><img class="icon_new_note" src="img/icon_new_note.png" alt="Nueva nota"></a>
          <div class="content_note">

            <form class="form_new_note" action="php/modifyUser.php" method="post">
              ';
              include ("php/manager_bbdd.php");
              $managerBBDD = new managerBBDD();
              $rows = $managerBBDD->getDatosUsuario($_SESSION['usuario']);
              $count= 0;
              foreach ($rows as $row) {
                if ($count>0) {
                  echo'
                  <p class="title_web">Perfil</p>
                  <label for="usuario">Usuario</label>
                  <input id="usuario" style="color:grey;" class="input_note" type="text" name="titulo" value="'.$_SESSION['usuario'].'" disabled/>
                  <label for="correo">Correo</label>
                  <input id="correo" class="input_note" name="email" type="email" required value="'.$row["CORREO"].'">
                  <!--<a class="btn_new_pass btn_note btn_cancel_change_note" href="#">Cambiar contraseña</a>-->
                  <div class="btn_options_new_note">

                    <a class="btn_apply_change_note btn_note btn_cancel_change_note" href="principal.php" onclick = "return confirm(\''."¿Estás seguro que quieres cancelar?, los nuevos datos introducidos se perderán".'\')">Cancelar</a>
                    <input class="btn_apply_change_note btn_note" type="submit" name="modificar_usuario" value="Aplicar">
                  </div>
                  ';
                }
                $count++;
              }
              echo '
            </form>

          </div>
      </div>
    </body>
    </html>
    ';
}else{
  header('Location: ./index.php');
}
?>
