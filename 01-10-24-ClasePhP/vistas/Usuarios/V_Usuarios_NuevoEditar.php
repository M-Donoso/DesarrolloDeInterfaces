<?php echo json_encode($datos);
$id_Usuario='';
$nombre='';
$apellido_1='';
$apellido_2='';
$sexo='';
$fecha_Alta=date('Y-m-d');
$mail='';
$login='';
$activo='S' ;
if (isset($datos['usuario'])) extract($datos['usuario']);

$cHombre = $sexo=='H' ? ' checked ': '';
$cMujer = $sexo=='M' ? ' checked ': '';
$cOtro = $sexo=='O' ? ' checked ': '';

$cactivo = $activo=='S' ? ' checked ': '';
$cinactivo = $activo=='N' ? ' checked ': '';


?>
<h2>Nuevo/Editar Usuario</h2>
<form id="formularioEdicion" name="formularioEdicion">
    <div class="row">
        <div class="form-group col-md-3 col-sm-12">
            <input type="hidden" id="id_Usuario" name="id_Usuario" value="<?php echo $id_Usuario?>">
            <label for="name">Nombre</label>
            <input required type="text" id="nombre" name="nombre" class="form-control" placeholder="Introduce tu Nombre" value="<?php echo $nombre; ?>"/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="apellido_1">Apellido_1</label>
            <input type="text" id="apellido_1" name="apellido_1" class="form-control" placeholder="Introduce tu 1ºApellido" value="<?php echo $apellido_1; ?>"/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="apellido_2">Apellido_2</label>
            <input type="text" id="apellido_2" name="apellido_2" class="form-control" placeholder="Introduce tu 2ºApellido" value="<?php echo $apellido_2; ?>"/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="mail">Mail</label>
            <input type="text" id="mail" name="mail" class="form-control" placeholder="Introduce tu Email" value="<?php echo $mail; ?>"/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" class="form-control" placeholder="Introduce tu Login" value="<?php echo $login; ?>"/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="fecha_Alta">Fecha_Alta</label>
            <input type="date" id="fecha_Alta" name="fecha_Alta" class="form-control" placeholder="" value="<?php echo $fecha_Alta; ?>"/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="sexo">Sexo</label>
            <div class="form-control">
                <input type="radio" id="sexo_male" name="sexo" value="M" <?php echo $cHombre?>> Masculino
                <input type="radio" id="sexo_female" name="sexo" value="M" <?php echo $cMujer?>> Femenino
                <input type="radio" id="sexo_otro" name="sexo" value="O" <?php echo $cOtro?>> Otro
            </div>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="factivo">Estado</label>
            <div class="form-control">
                <input type="radio" id="activo" name="activo" value="S" <?php echo $cactivo ?>> Activo
                <input type="radio" id="inactivo" name="activo" value="N" <?php echo $cinactivo?>> Inactivo
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary" onclick="guardarUsuario();">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="buscar('Usuarios', 'getVistaListadoUsuarios', 'formularioBuscar', 'capaResultadosBusqueda')">Cancelar</button>
            <span id="msjError" name="msjError" style="color:blue"></span>
        </div>
    </div>
    </form>






