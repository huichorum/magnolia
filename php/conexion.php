<?php

$conexion = mysqli_connect('localhost', 'root', '', 'magnolia')
      or die(mysqli_error($mysqli));
if (isset($_POST['enviar']))
      insertar($conexion);
if (isset($_POST['login']))
      login($conexion);
if (isset($_POST['cerrar']))
      cerrar_sesion();
if (isset($_POST['agregar']))
      agregar_carrito($conexion);
if (isset($_POST['update']))
      actualiza_carrito($conexion);
if (isset($_POST['borrar_carrito']))
      borrar_carrito($conexion);
if (isset($_POST['pago']))
      pago($conexion);

function insertar($conexion)
{
      // $id= $_POST["id"];
      $nombre = $_POST["nombre"];
      $telefono = $_POST["telefono"];
      $email = $_POST["email"];
      $contraseña = $_POST["contraseña"];
      // $calle = $_POST["calle"];
// $colonia = $_POST["colonia"];
// $codigo = $_POST["codigo"];
// $estado = $_POST["estado"];

      $consulta = "INSERT INTO usuarios(Nombre, Telefono, Email, Contraseña)
      VALUES ('$nombre', '$telefono', '$email', '$contraseña')";
      mysqli_query($conexion, $consulta);
      // $consultadir = "INSERT INTO direccion(Nusuario, Calle, Colonia, CP, Estado)
      // VALUES ('$id', '$calle','$colonia','$codigo','$estado')";
      // mysqli_query($conexion, $consultadir);
      // mysqli_close($conexion);
      session_start();
      $_SESSION['sesion'] = true;
      $_SESSION['Nombre'] = $nombre;
      header('Location: ../registro.php');

}

function login($conexion)
{

      $user = $_POST["user"];
      $pass = $_POST["pass"];

      $consulta = "SELECT Nusuario, Nombre, Email, Contraseña FROM usuarios WHERE Email = '" . $user . "'";
      $query = mysqli_query($conexion, $consulta);
      if ($query == false)
            echo "<script>alert('No encontré registro')</script>";
      $datos = mysqli_fetch_assoc($query);

      if ($user == $datos["Email"]) {
            if ($pass == $datos["Contraseña"]) {
                  session_start();
                  $_SESSION['sesion'] = true;
                  $_SESSION['Nusuario'] = $datos["Nusuario"];
                  $_SESSION['Nombre'] = $datos["Nombre"];
            } else {
                  echo "<script>alert('Contraseña incorrecta')</script>";
                  // header('Location: ../registro.php');
            }
      } else {
            echo "<script>alert('No existe usuario')</script>";
            // echo "hola";
            // header('Location: ../registro.php');
      }
      echo "<script>window.location.replace('/Magnolia/registro.php');</script>";


}

function agregar_carrito($conexion)
{
      echo $_SERVER['HTTP_REFERER'];
      if (!isset($_POST['usuario'])) {
            echo "<script>alert('Para agregar productos al carrito necesitas iniciar sesión')</script>";
            echo "<script>window.location.replace('/Magnolia/registro.php');</script>";
      } else {
            $usuario = $_POST['usuario'];
            $idropa = $_POST['ropa'];
            $idcategoria = $_POST['categoria'];
            $producto = $_POST['producto'];
            $precio = $_POST['precio'];
            $cantidad = 1;
            $consulta = "SELECT Cantidad FROM carrito WHERE Nusuario =$usuario AND IDropa = '$idropa'";
            echo $consulta;
            $query = mysqli_query($conexion, $consulta);
            $datos = mysqli_fetch_assoc($query);
            if (isset($datos['Cantidad'])) {
                  $cantidad = $datos['Cantidad'] + 1;
                  $total = $cantidad * $precio;
                  $consulta = "UPDATE carrito SET Cantidad=$cantidad , Total=$total WHERE Nusuario=$usuario AND IDropa='$idropa'";
                  echo "<br>" . $consulta;
                  if (!$query = mysqli_query($conexion, $consulta)) {
                        echo mysqli_error($conexion);
                        mysqli_free_result($query);
                  } else {
                        session_start();
                        $_SESSION['carrito'] = true;
                        $_SESSION['cdesc'] = $producto . " se agrego al carrito =)";

                  }
            } else {
                  $total = $cantidad * $precio;
                  $consulta = "INSERT INTO carrito(Nusuario,IDropa,IDcategoria,Producto,Precio,Cantidad,Total,Imagen) VALUE($usuario,'$idropa','$idcategoria','$producto',$precio,$cantidad,$total,";
                  $consulta = $consulta . "(SELECT Imagen FROM catalogo WHERE IDropa='$idropa'))";
                  echo "<br>" . $consulta;
                  if (!$query = mysqli_query($conexion, $consulta)) {
                        echo mysqli_error($conexion);
                        mysqli_free_result($query);
                  } else {
                        session_start();
                        $_SESSION['carrito'] = true;
                        $_SESSION['cdesc'] = $producto . " se agrego al carrito =)";
                  }
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
}

function actualiza_carrito($conexion)
{
      $usuario = $_POST['user'];
      $idropa = $_POST['ropa'];
      $producto = $_POST['producto'];
      $cantidad = $_POST['cantidad'];
      $total = $_POST['total'];
      if ($cantidad == 0) {
            $consulta = "DELETE FROM carrito WHERE Nusuario=$usuario AND IDropa='$idropa'";
      } else {
            $consulta = "UPDATE carrito SET Cantidad=$cantidad , Total=$total WHERE Nusuario=$usuario AND IDropa='$idropa'";
      }
      if (!$query = mysqli_query($conexion, $consulta)) {
            echo mysqli_error($conexion);
            mysqli_free_result($query);
      } else {
            session_start();
            $_SESSION['carrito'] = true;
            $_SESSION['cdesc'] = $producto . " se actualizo en el carrito";
            echo "<script>window.location.replace('/Magnolia/carrito.php');</script>";
      }

}

function borrar_carrito($conexion)
{
      session_start();
      $usuario = $_SESSION['Nusuario'];
      $consulta = "DELETE FROM carrito WHERE Nusuario=$usuario";
      if (!$query = mysqli_query($conexion, $consulta)) {
            echo mysqli_error($conexion);
            mysqli_free_result($query);
      } else
            echo "<script>window.location.replace('/Magnolia/carrito.php');</script>";
}

function pago($conexion)
{
      echo "<script>console.log('entre a pag');</script>";
      session_start();
      $tarjeta = $_POST['tarjeta'];
      $cvv = $_POST['cvv'];
      if (strlen($tarjeta) != 16) {
            echo "<script>alert('Tarjeta inválida, vuelva a intentarlo');</script>";
            echo "<script>window.location.replace('/Magnolia/carrito.php');</script>";
      } else if (strlen($cvv) != 3) {
            echo "<script>alert('CVV inválido, vuelva a intentarlo');</script>";
            echo "<script>window.location.replace('/Magnolia/carrito.php');</script>";

      } else {
            $usuario = $_SESSION['Nusuario'];
            $consulta = "DELETE FROM carrito WHERE Nusuario=$usuario";
            if (!$query = mysqli_query($conexion, $consulta)) {
                  echo mysqli_error($conexion);
                  mysqli_free_result($query);
                  echo "<script>alert('Tu pago falló, vuelva a intentar');</script>";
                  echo "<script>window.location.replace('/Magnolia/carrito.php');</script>";
            } else {
                  echo "<script>alert('Tu pago se a realizado con éxito');</script>";
                  echo "<script>window.location.replace('/Magnolia/carrito.php');</script>";
            }
      }
}

function cerrar_sesion()
{
      session_start();
      $_SESSION = array();
      session_destroy();
      header("Location:../registro.php");
}

?>