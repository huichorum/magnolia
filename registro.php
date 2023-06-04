<?php
session_start();
include("php/conecta.php");
?>
<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="src/magnolia.png" type="">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/estilo.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


  <title>Magnolia</title>
</head>

<!-- <style>
      h1{
        text-align: center;
        width: 50%;
        margin: auto;
        margin-top: 30 px;
        font-size: 50px;
      }
      table{
        border: 3px solid #000000;
        padding: 20px 50px;
        margin-top: 20px;
        border-radius: 5px;
        background-color: #678E5F;
        font-size: 25px;
      }
    </style> -->

<body>
  <script src="js/acciones.js"></script>
  <div class="position-fixed bottom-10 end-0 p-3" style="z-index: 11">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="liveToast" data-autohide="false">
      <div class="toast-header">
        <img src="src/bolsa.png" class="rounded me-2" alt="Notificación">
        <strong class="me-auto">Agregado al carrito</strong>
        <small class="text-muted">Justo ahora</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">X</button>
      </div>
      <div class="toast-body">
        Producto agregado al carrito
      </div>
    </div>
  </div>
  <div class="container-lg-fluid">
    <br>
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="index.php"><img width="250" src="img/logo_dos.png" alt="..." /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
              aria-expanded="true"><span class="nav-label">Mujer<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="text_desc" href="mujerabrigosychamarras.php">Abrigos y chamarras</a></li>
              <li><a class="text_desc" href="mujerblusas.php">Blusas, playeras y camisas</a></li>
              <li><a class="text_desc" href="mujerfaldas.php">Faldas y vestidos</a></li>
              <li><a class="text_desc" href="mujerjeans.php">Jeans y shorts</a></li>
              <li><a class="text_desc" href="mujersueteres.php">Suéteres y sudaderas</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true"
              aria-expanded="true"><span class="nav-label">Hombre<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="text_desc" href="abrigosychamarrash.php">Abrigos y chamarras</a></li>
              <li><a class="text_desc" href="camisash.php">Camisas, playeras y polos</a></li>
              <li><a class="text_desc" href="pantalonesyshortsh.php">Pantalones y shorts</a></li>
              <li><a class="text_desc" href="sueteresysudaderash.php">Suéteres y sudaderas</a></li>
            </ul>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="carrito.php"><img src="src/bolsa.png" alt="bolsa"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registro.php"><img src="src/registro.png" alt="registro"></a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- <button type="button" class="btn btn-primary" id="liveToastBtn" onclick="notifica()">Mostrar el toast en
    vivo</button> -->

  <?php if (!isset($_SESSION['sesion'])) { ?>
    <div class="container" id="login">
      <h1>Inicia Sesión</h1>
      <form class="form-horizontal" action="php/conexion.php" method="POST">
        <div class="form-group">
          <label id="sesion" for="user" class="usuario">Correo:</label>
          <input type="email" id="user" class="form-control" name="user" placeholder="Correo" maxlength="100" required>
        </div>
        <div class="form-group">
          <label id="sesion" for="password" class="pass">Password</label>
          <input id="password" type="password" class="form-control" name="pass" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Ingresar</button>
        <button type="button" class="btn btn-link" onclick="registro(0)" id="bregistro">Registro</button>
      </form>

    </div>
    <div class="container" id="registro" hidden>
      <h1>Registro</h1>
      <form action="php/conexion.php" method="post">
        <table>
          <tr>
            <td>Nombre:</td>
            <td>
              <input type="text" name="nombre" placeholder="Nombre completo" required />
            </td>
          </tr>

          <tr>
            <td>Telefono:</td>
            <td>
              <input type="number" name="telefono" minlength="10" maxlength="10" placeholder="55 5555 5555" required />
            </td>
          </tr>

          <tr>
            <td>Email:</td>
            <td>
              <input type="email" name="email" placeholder="xxxxx@gmail.com" required />
            </td>
          </tr>



          <tr>
            <td>Contraseña:</td>
            <td>
              <input type="text" name="contraseña" placeholder="Contraseña" required />
            </td>
          </tr>

          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <button type="reset" class="btn btn-secondary" name="borrar">Restablecer</button>
            </td>
            <td>
              <button type="submit" class="btn btn-primary" name="enviar">Registrar</button>
            </td>
            <td><button class="btn btn-primary" onclick="registro(1)">Inicia Sesión</button></td>
          </tr>
        </table>
      </form>
    </div>
  <?php } else {
    ?>
    <div class="container">
      <div class="contenedor-login">
        <h1>Bienvenido
          <?php echo $_SESSION['Nombre']; ?>
        </h1>
        <form action="php/conexion.php" method="post">
          <button type="submit" class="btn btn-info" name="cerrar">Cierra Sesión</button>
        </form>
      </div>
    </div>
  <?php } ?>
    <br>
  <div class="container-fuid">
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="full">
              <div class="logo_footer">
                <a href="#"><img width="210" src="img/logo_dos.png" alt="#" /></a>
              </div>
              <div class="information_f">
                <p><strong>Dirección:</strong>Av. teoloyucan km 2.5, San Sebastian Xhala, 54714 Cuautitlán Izcalli, Edo.
                  México</p>
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.5635350382017!2d-99.19184202505726!3d19.6886178816462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f56018340489%3A0xeef9543b68277040!2sCuautitl%C3%A1n%20-%20Teoloyucan%20Km%202.5%2C%20San%20Sebastian%20Xhala%2C%2054714%20Cuautitl%C3%A1n%20Izcalli%2C%20M%C3%A9x.!5e0!3m2!1ses-419!2smx!4v1682912503276!5m2!1ses-419!2smx"
                  width="350" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p><strong>Teléfono:</strong> 55 56565656</p>
                <p><strong>Email:</strong> fescuautitlan@comunidad.unam.mx</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="widget_menu">
              <h3>Menú</h3>
              <ul>
                <li><a href="src/mision.pdf" target="_blank">Misión</a></li>
                <li><a href="src/vision.pdf" target="_blank">Visión</a></li>
                <li><a href="src/valores.pdf" target="_blank">Valores</a></li>
                <li><a href="src/terminos-y-condiciones.pdf" target="_blank">Términos y condiciones</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
      -->
</body>

</html>