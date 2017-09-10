<?php
  function getRutaform(){//Comprobar si se desea crear una nueva nota o modificarla
    if(preg_match('(\/newNota\.php\?modify\=)',$_SERVER["REQUEST_URI"])){
      return "php/change_nota.php";
    }else if(preg_match('(\/newNota\.php\?new)',$_SERVER["REQUEST_URI"])){
      return "php/newNotaUnica.php";
    }
    return "";
  }
  function getTipoRuta(){
    if(preg_match('(\/newNota\.php\?modify\=)',$_SERVER["REQUEST_URI"])){
      return "modify";
    }else if(preg_match('(\/newNota\.php\?new)',$_SERVER["REQUEST_URI"])){
      return "new";
    }
    return "";
  }

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

              <a href="#"><span>'.$_SESSION["usuario"].'</span><img class="arrow" src="img/arrow_desplegable.png" alt=""></a>
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
        <div class="bloque_opacity" onclick="selectButtonMenu();"></div>
        <div class="content_note">

          <form class="form_new_note" action="'.getRutaform().'" method="post">
            ';
            if(getTipoRuta()==='modify'){
              include ("php/manager_bbdd.php");
              $url = str_replace("/newNota.php?".getTipoRuta()."=","",$_SERVER["REQUEST_URI"]);
              $managerBBDD = new managerBBDD();
              $rows = $managerBBDD->getNotaUnica($url);
              $count= 0;
              foreach ($rows as $row) {
                if ($count>0) {
                  echo'
                  <p class="title_web">Nota</p>
                  <label for="titulo">Titulo</label>
                  <input id="titulo" class="input_note" type="text" name="titulo" value="'.$row["TITULO"].'" required/>
                  <label for="texto">Texto</label>
                  <textarea id="texto" class="input_note" name="texto" required>'.$row["TEXTO"].'</textarea>
                  <input class="input_title_antigulo" type="text" name="titulo_antiguo" value="'.$row["TITULO"].'" required/>
                  ';
                }
                $count++;

              }

            }else{
              echo'<p class="title_web">Nota</p>
              <label for="titulo">Titulo</label>
              <input id="titulo" class="input_note" type="text" name="titulo" required/>
              <label for="texto">Texto</label>
              <textarea id="texto" class="input_note" name="texto" required></textarea>';
            }



            echo'
            <input class="input_usuario" type="text" name="usuario" value="'.$_SESSION["usuario"].'">
            <div class="btn_options_new_note">

              <a class="btn_apply_change_note btn_note btn_cancel_change_note" href="principal.php" onclick = "return confirm(\''."¿Estás seguro que quieres cancelar?, los nuevos datos introducidos se perderán".'\')">Cancelar</a>
              <input class="btn_apply_change_note btn_note" type="submit" name="crear_note" value="Aplicar">
            </div>
          </form>
        </div>
    </div>
  </body>
  </html>
  ';
}else{
  header("Location: ./index.html");
}

?>
