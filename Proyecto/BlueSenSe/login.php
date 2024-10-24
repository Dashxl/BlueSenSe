<?php
session_start();
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<Head>
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Y Registro</title>
<link rel="stylesheet" src="/css/estilos.css/">

</Head>
<body>
    
    <style>
        body {
        background-color: #f5f0e1; /* Color beige claro inspirado en el fondo del logo */
        }
            *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        font-family: sans-serif;
      }
      
      main{
          width: 100%;
          padding: 20px;
          margin: auto;
          margin-top: 100px;
      }
      
       .contenedor__todo{
          width: 100;
          max-width: 800px;
          margin: auto;
          position: relative;
       }
      
      .caja__trasera{
          width: 100%;
          padding: 10px 20 px;
          display: flex;
          justify-content: center;
          backdrop-filter: blur(10px);
          background-color: rgba(0, 128, 255, 0.5);
      }
      
      .caja__trasera div{
          margin: 100px 40px;
          color: white;
          transition: all 500ms;
      }
      
      .caja__trasera div p,
      .caja__trasera div button{
          margin-top: 30px;
      }
      
      .caja__trasera div h3{
          font-weight: 400;
          font-size: 26px;
      }
      
       .caja__trasera button{
          padding: 10px 40px;
          border: 2px solid #fff;
          background: transparent;
          font-size: 14px;
          font-weight: 600;
          cursor: pointer;
          color: white;
          outline: none;
          transform: all 300ms;
       }
      
       .caja__trasera button:hover{
          background: #fff;
          color: #46A2FD;
       }
      
      /*formulario*/
      
      .contenedor__login-register{
          display: flex;
          align-items: center;
          width: 100%;
          max-width: 380px;
          position: relative;
          top: -185px;
          left: 10px;
          transition: left 500ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
      }
      
      .contenedor__login-register form{
          width: 100%;
          padding: 80px 20px;
          background: #fff;
          position: absolute;
          border-radius: 20px;
      }
      
      .contenedor__login-register form h2{
          font-size: 30px;
          text-align: center;
          margin-bottom: 20px;
          color: #46A2FD;
      }
      
      .contenedor__login-register form input{
          width: 100%;
          margin-top: 20px;
          padding: 10px;
          border: none;
          background: #f2f2f2;
          font-size: 16px;
          outline: none;
      }
      
      .contenedor__login-register form button{
          padding: 10px 40px;
          margin-top: 40px;
          border: none;
          font-size: 14px;
          background: #46A2FD;
          color: white;
          cursor: pointer;
          outline: none;
      }
      
      .formulario__login{
          opacity: 1;
          display: block;
      }
      
      .formulario__registro{
          display: none; 
      }
      
      /*responsive design*/
          
      @media screen and (max-width: 850px){
          main{
              margin-top: 50px;
          }
      
          .caja__trasera{
              max-width: 350px;
              height: 300px;
              flex-direction: column;
              margin: auto;
          }
      
          .caja__trasera div{
              margin: 0px;
              position: absolute;
          }
      
          /*formulario*/
          .contenedor__login-register{
              top: -10px;
              left: -5px;
              margin: auto;
          }
      
          .contenedor__login-register form{
              position: relative;
          }
      }
      </style>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <main>
         <div class="contenedor__todo"> 

            <div class="caja__trasera"> 
            <div class="caja__trasera-login">
                <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia Sesion para ordenar</p>
             <button id="btn__iniciar-sesion">Iniciar Sesion</button>
            </div>
            <div class="caja__trasera-register">
                <h3>¿Aun no tienes cuenta?</h3>
                <p>Crea una cuenta</p>
             <button id="btn__registrarse">Registrarse</button>
            </div>
            </div>
    
          <div class="contenedor__login-register">
          <form action="login.php" method="POST" class="formulario__login">
                <h2>Iniciar Sesion</h2>
                <input type="text" name="correo_electronico" placeholder="Correo Electronico" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>  
                <button type="submit">Entrar</button>
            </form>

            <form action="register.php" method="POST" class="formulario__registro">
                <h2>Registrarse</h2>
                <input type="text" name="nombre_completo" placeholder="Nombre Completo" required>
                <input type="email" name="correo_electronico" placeholder="Correo Electronico" required>
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button type="submit">Registrarse</button>
            </form>


          </div> 
         </div>

      <?php   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE correo_electronico = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo_electronico);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $usuario['usuario'];
            $_SESSION['correo_electronico'] = $usuario['correo_electronico'];
            header("Location: dashboard.php");
            exit();
        } else {
                ?>
                <br>
                <div class= "container" align= "center">
                <div class="alert alert-success" role="alert">
                <h3>Contraseña Incorrecta</h3>
                <h4>Intentelo de Nuevo</h4>
                </div>
            </div>
    <?php

        }
    } else {
        ?>
        <br>
        <div class= "container" align= "center">
        <div class="alert alert-success" role="alert">
        <h3>Correo Electronico Incorrecto</h3>
        <h4>Intentelo de Nuevo</h4>
        </div>
    </div>
<?php
    }

    $stmt->close();
    $conn->close();
}

?>
   </main>

   
   <script>
  //Ejecutando funciones
document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);

//Declarando variables
var formulario_login = document.querySelector(".formulario__login");
var formulario__registro = document.querySelector(".formulario__registro");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

    //FUNCIONES

function anchoPage(){

    if (window.innerWidth > 850){
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    }else{
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario__registro.style.display = "none";   
    }
}

anchoPage();


    function iniciarSesion(){
        if (window.innerWidth > 850){
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "10px";
            formulario__registro.style.display = "none";
            caja_trasera_register.style.opacity = "1";
            caja_trasera_login.style.opacity = "0";
        }else{
            formulario_login.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario__registro.style.display = "none";
            caja_trasera_register.style.display = "block";
            caja_trasera_login.style.display = "none";
        }
    }

    function register(){
        if (window.innerWidth > 850){
            formulario__registro.style.display = "block";
            contenedor_login_register.style.left = "410px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.opacity = "0";
            caja_trasera_login.style.opacity = "1";
        }else{
            formulario__registro.style.display = "block";
            contenedor_login_register.style.left = "0px";
            formulario_login.style.display = "none";
            caja_trasera_register.style.display = "none";
            caja_trasera_login.style.display = "block";
            caja_trasera_login.style.opacity = "1";
        }
}
    </script>
</body>

</html>




