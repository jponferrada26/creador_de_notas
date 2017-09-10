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
        <section class="mynotas">
        ';

         include 'php/manager_bbdd.php';
         $managerBBDD = new ManagerBBDD();
         $rows = $managerBBDD->getNotas($_SESSION['usuario']);
         $count = 0;
         foreach ($rows as $row) {
           if($count>0){
              echo '
              <article class="nota">
                <div class="title_nota_widget">
                  <p>'.$row["TITULO"].'</p>
                </div>
                <div class="resumen_text_note">
                  <p>'.$row["TEXTO"].'</p>
                </div>
                <div class="buttons_options_note">
                  <a href="newNota.php?modify='.$row["URL"].'" class="btn_note">MODIFICAR</a>
                  <form class="form_delete_note" action="php/remove_note.php" method ="post">
                    <input class="btn_note" type="submit" name="logout" value="BORRAR" onclick = "return confirm(\''."¿Estás seguro que quieres borrar ésta nota?".'\')">
                    <input class="info_note_to_delete" type="text" name="note_to_delete" value="'.$row["URL"].'"/>
                  </form>
                </div>
              </article>
              ';
            }
            $count++;
          }
        echo '
        </section>
    </div>
  </body>
  </html>
  ';
}else{
  header('Location: ./index.html');
}
?>
