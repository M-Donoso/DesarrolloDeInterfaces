<?php session_start(); 

$usuario='';
$password='';
extract($_POST);

if($usuario== '' || $password== ''){
    $msj='Debes completar los campos.';
}else{
    if($usuario=='javier' && $password=='123'){

        $_SESSION['login']=$usuario;

        header('Location: index.php'); //saltar a esta pagina (no puede haber pintado nada antes)
    }else{
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
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }
        .login-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h1 {
            margin-bottom: 20px;
        }
        .login-container input {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .login-container button {
            width: 99%;
            padding: 10px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
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