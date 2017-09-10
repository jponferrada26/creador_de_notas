<?php
  include("class_conexion.php");
  class ManagerBBDD{
    public function getNotas($usuario){//return notas dependiendo del usuario indicado por parámetro
      $rows[] = null;
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT URL,TITULO,CONCAT(SUBSTRING(TEXTO,1,250),'...','') AS TEXTO FROM NOTAS WHERE USUARIO = '".$usuario."';";
      $declaracion  = $conexion ->prepare($sql);
      $declaracion->execute();
      while($result = $declaracion->fetch()){
        $rows[] = $result;
      }
      return $rows;
    }

    public function getNotaUnica($url){//return datos de una nota por su url
      $rows[] = null;
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM NOTAS WHERE URL = '".$url."';";
      $declaracion  = $conexion ->prepare($sql);
      $declaracion->execute();
      while($result = $declaracion->fetch()){
        $rows[] = $result;
      }
      return $rows;
    }


    public function removeNote($url_note){//borrar la nota dependiendo de la url de dicha nota
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "DELETE FROM NOTAS WHERE URL = '".$url_note."';";
      $declaracion  = $conexion ->prepare($sql);
      $declaracion->execute();
    }

    public function newNota($titulo,$texto,$usuario){//crear una nueva nota
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "INSERT INTO NOTAS(URL,TITULO,TEXTO,USUARIO) VALUES(:URL,:TITULO,:TEXTO,:USUARIO);";
      $declaracion = $conexion->prepare($sql);

      $url = str_replace(' ','-',$titulo);

      $declaracion->bindParam(':URL',$url);
      $declaracion->bindParam(':TITULO',$titulo);
      $declaracion->bindParam(':TEXTO',$texto);
      $declaracion->bindParam(':USUARIO',$usuario);

      if($declaracion){
        $declaracion ->execute();
        header("Location: ../principal.php");

      }else{
        echo 'No se ha podido crear la nota.';
      }
    }

    public function modifyNota($tituloAntiguo,$titulo,$texto,$usuario){//cambiar los datos de una nota
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "UPDATE NOTAS SET URL=:URL,TITULO = :TITULO,TEXTO = :TEXTO,USUARIO =:USUARIO  WHERE TITULO = :TITULO_ANTIGUO ;";
      //"UPDATE NOTAS SET URL=".str_replace(' ','-',$titulo).",TITULO = ".$titulo.",TEXTO = ".$texto." WHERE USUARIO = ".$usuario." AND URL = ".str_replace(' ','-',$titulo).";";
      $declaracion = $conexion->prepare($sql);

      $declaracion->bindParam(':URL',str_replace(' ','-',$titulo));
      $declaracion->bindParam(':TITULO',$titulo);
      $declaracion->bindParam(':TEXTO',$texto);
      $declaracion->bindParam(':USUARIO',$usuario);
      $declaracion->bindParam(':TITULO_ANTIGUO',$tituloAntiguo);

      $declaracion ->execute();
      header("Location: ../principal.php");
    }

    public function getDatosUsuario($usuario){//return datos del usuario, indicando el nombre del mismo.
      $rows[] = null;
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT USUARIO,CORREO FROM USUARIOS WHERE USUARIO = '".$usuario."';";
      $declaracion  = $conexion ->prepare($sql);
      $declaracion->execute();
      while($result = $declaracion->fetch()){
        $rows[] = $result;
      }
      return $rows;
    }

    public function modifyUsuario($correo,$usuario){//modificar datos de un usuario en concreto
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "UPDATE USUARIOS SET CORREO=:CORREO WHERE USUARIO = :USUARIO ;";
      //"UPDATE NOTAS SET URL=".str_replace(' ','-',$titulo).",TITULO = ".$titulo.",TEXTO = ".$texto." WHERE USUARIO = ".$usuario." AND URL = ".str_replace(' ','-',$titulo).";";
      $declaracion = $conexion->prepare($sql);

      $declaracion->bindParam(':CORREO',$correo);
      $declaracion->bindParam(':USUARIO',$usuario);

      $declaracion ->execute();
      header("Location: ../principal.php");
    }

  }
?>
