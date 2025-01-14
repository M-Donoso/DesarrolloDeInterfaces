<?php session_start(); 

$usuario='';
$password='';
extract($_POST);

if($usuario== '' || $password== ''){
    $msj='Debes completar los campos.';
}else{
    // Verificar usuario y password contra la BD
    require_once 'controladores/C_Usuarios.php';
    $objCont = new C_Usuarios();
    $id_Usuario=$objCont->validarUsuario(array('usuario'=>$usuario, 'password'=>$password));
    if($id_Usuario!=''){

        header('Location: index.php'); //saltar a esta pagina (no puede haber pintado nada antes)
    }else{
        unset($_SESSION['login']);
        unset($_SESSION['id_Usuario']);
        $msj='NO es correcto.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Formulario</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
            max-width: 100%;
        }
        .login-logo {
            width: 90px;
            margin-bottom: -20px;
        }
        .login-container h1 {
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-container button:hover {
            background-color: #45a049;
        }    
    </style>
</head>
<body>
    <div class="login-container">
        <img src="icono/512x512.png" alt="Logo" class="login-logo">
        <h1>Login</h1>
        <form id="formularioLogin" method="post" action="login.php">
            <input type="text" name="usuario" id="login" placeholder="Usuario" required value="<?php echo $usuario; ?>">
            <input type="password" name="password" id="password" placeholder="Contraseña" required value="<?php echo $password; ?>">
            <span id="msj" class="msj"><?php echo $msj; ?></span>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>




