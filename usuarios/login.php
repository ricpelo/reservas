<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Inicio de sesión</title>
  </head>
  <body><?php

    require '../comunes/auxiliar.php';

    if (isset($_SESSION['usuario'])) {
        header("Location: ../reservas/reindex.php");
        return;
    }

    if (isset($_POST['nick'], $_POST['password'])):
      $nick = trim($_POST['nick']);
      $password = trim($_POST['password']);
      conectar();
      $res = pg_query_params("select id
                                from usuarios
                               where nick = $1 and
                                     password = md5($2)",
                             array($nick, $password));
      if (pg_num_rows($res) > 0):
        $fila = pg_fetch_assoc($res, 0);
        $_SESSION['usuario'] = $fila['id'];
        header("Location: ../reservas/reindex.php");
        return;
      else: ?>
        <h3>Error: contraseña no válida</h3><?php
      endif;
    endif; ?>

    <form action="login.php" method="post">
      <label for="nick">Nombre:</label>
      <input type="text" name="nick" /><br/>
      <label for="password">Contraseña:</label>
      <input type="password" name="password" /><br/>
      <input type="submit" value="Entrar" />
    </form>
  </body>
</html>
  
    
