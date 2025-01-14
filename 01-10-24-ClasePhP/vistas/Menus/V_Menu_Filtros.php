<h2>Mtto. de Menu</h2>
<div class="container-fluid" id="capaFiltrosBusqueda">
    <form id="formularioBuscar" name="formularioBuscar">
        <div class="row">

            <div class="form-group col-md-6 col-sm-12">
                <label for="ftexto">Nombre/texto:</label>
                <input type="text" id="ftexto" name="ftexto" class="form-control" placeholder="Texto a buscar" value="">

            </div>
            <div class="form-group col-md-6 col-sm-12">
                <label for="factivo">Estado:</label>
                <select id="factivo" name="factivo" class="form-control">
                    <option value="" selected>Todos</option>
                    <option value="S">Activos</option>
                    <option value="N">NO Activos</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <button type="button" class="btn btn-outline-primary" onclick="obtenerVista('Menu', 'getVistaMenuEditar', 'capaMttoMenu')">Buscar</button>

                <button type="button" class="btn btn-outline-primary" onclick="">Otra Accion</button>

            </div>
        </div>
    </form>

</div>

<div class="container-fluid" id="capaMttoMenu"></div>