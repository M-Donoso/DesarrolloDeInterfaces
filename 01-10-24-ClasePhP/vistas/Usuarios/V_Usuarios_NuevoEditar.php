<h2>Nuevo Usuario</h2>
<form id="formularioEdicion" name="formularioEdicion">
    <div class="row">
        <div class="form-group col-md-3 col-sm-12">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Introduce tu Nombre" value=""/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="apellido_1">Apellido_1</label>
            <input type="text" id="apellido_1" name="apellido_1" class="form-control" placeholder="Introduce tu 1ºApellido" value=""/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="apellido_2">Apellido_2</label>
            <input type="text" id="apellido_2" name="apellido_2" class="form-control" placeholder="Introduce tu 2ºApellido" value=""/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="mail">Mail</label>
            <input type="text" id="mail" name="mail" class="form-control" placeholder="Introduce tu Email" value=""/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="login">Login</label>
            <input type="text" id="login" name="login" class="form-control" placeholder="Introduce tu Login" value=""/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="fecha_Alta">Fecha_Alta</label>
            <input type="date" id="fecha_Alta" name="fecha_Alta" class="form-control" placeholder="" value=""/>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="sexo">Sexo</label>
            <div class="form-control">
                <input type="radio" id="sexo_male" name="sexo" value="male"> Masculino
                <input type="radio" id="sexo_female" name="sexo" value="female"> Femenino
                <input type="radio" id="sexo_otro" name="sexo" value="otro"> Otro
            </div>
        </div>

        <div class="form-group col-md-3 col-sm-12">
            <label for="factivo">Estado</label>
            <div class="form-control">
                <input type="radio" id="activo" name="factivo" value="Activo"> Activo
                <input type="radio" id="inactivo" name="factivo" value="Inactivo"> Inactivo
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-primary" onclick="guardarUsuario();">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="document.getElementById('capaEditarCrear').innerHTML = '';">Cancelar</button>
            <span id="msjError" name="msjError" style="color:blue;"></span>
        </div>
    </div>
    </form>






