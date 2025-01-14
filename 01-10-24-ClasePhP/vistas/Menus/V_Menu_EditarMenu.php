<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Gestión de Menú</h1>

    <?php
    function obtenerSubmenus($menuId, $datos)
    {
        $submenus = [];
        foreach ($datos as $item) {
            if (!empty($item['id_padre']) && $item['id_padre'] == $menuId) {
                $submenus[] = $item;
            }
        }
        return $submenus;
    }

    usort($datos, function ($a, $b) {
        return $a['posicion'] - $b['posicion'];
    });
    ?>

    <?php foreach ($datos as $menuItem): ?>
        <?php if (empty($menuItem['id_padre'])): ?>
            <div class="hidden-div card border-success mb-2" style="display: none; background-color: #f9fdf9;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-success">Nombre</p>
                        <input type="text" class="form-control me-2 nuevo-nombre" placeholder="Nuevo nombre de apartado">
                        <p class="text-success">Función</p>
                        <input type="text" class="form-control me-2 funcion" placeholder="Función del apartado">
                        <button class="btn btn-outline-success btn-sm" onclick="crearNuevoApartado(this, <?= $menuItem['posicion'] ?>, <?= $menuItem['id_padre'] ?>)">Guardar</button>
                    </div>
                </div>
            </div>

            <div class="card mb-3 shadow-sm position-relative" data-id="<?= $menuItem['id'] ?>" style="border-color: #007bff;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-primary"><i class="bi bi-folder-fill me-2"></i><?= htmlspecialchars($menuItem['titulo']) ?></h5>
                        </div>
                        <div>
                            <button class="btn btn-outline-info btn-sm me-2" onclick="document.getElementById('subMenu<?= $menuItem['id'] ?>').style.display = 'block';">Crear Submenú</button>
                            <button class="btn btn-outline-success btn-sm me-2" onclick="if (this.closest('.card').previousElementSibling) { this.closest('.card').previousElementSibling.style.display = 'block'; } else { document.getElementById('subMenuUltimo').style.display = 'block'; }">Crear Arriba</button>
                            <i class="bi bi-pencil-square text-primary me-2 fs-5" style="cursor: pointer;" title="Editar" onclick="document.getElementById('editForm<?= $menuItem['id'] ?>').style.display = 'block';"></i>
                            <i class="bi bi-box-seam text-secondary me-2 fs-5" style="cursor: pointer;" title="Cubo"></i>
                            <i class="bi bi-trash-fill text-danger fs-5" style="cursor: pointer;" title="Eliminar" onclick="eliminarApartado(<?= $menuItem['id'] ?>)"></i>
                        </div>
                    </div>

                    <?php $submenus = obtenerSubmenus($menuItem['id'], $datos); ?>
                    <?php if (!empty($submenus)): ?>
                        <div class="mt-3">
                            <h6 class="text-secondary">Submenús:</h6>
                            <ul class="list-group">
                                <?php foreach ($submenus as $submenu): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?= $submenu['id'] ?>" style="border-color: #28a745;">
                                        <span class="text-dark"> <i class="bi bi-file-text me-2"></i><?= htmlspecialchars($submenu['titulo']) ?></span>
                                        <div>
                                            <i class="bi bi-pencil-square text-primary me-2 fs-6" style="cursor: pointer;" title="Editar submenú" onclick="document.getElementById('editFormSubmenu<?= $submenu['id'] ?>').style.display = 'block';"></i>
                                            <i class="bi bi-box-seam text-secondary me-2 fs-6" style="cursor: pointer;" title="Cubo"></i>
                                            <i class="bi bi-trash-fill text-danger fs-6" style="cursor: pointer;" title="Eliminar submenú" onclick="eliminarApartado(<?= $submenu['id'] ?>)"></i>
                                        </div>
                                    </li>

                                    <div class="hidden-div card-body mt-2" id="editFormSubmenu<?= $submenu['id'] ?>" style="display: none; background-color: #f1f8f1; border: 1px solid #28a745;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="text-success">Nuevo nombre</p>
                                            <input type="text" class="form-control me-2 nuevo-nombre" value="<?= htmlspecialchars($submenu['titulo']) ?>" id="inputNombreSubmenu<?= $submenu['id'] ?>">
                                            <p class="text-success">Función</p>
                                            <input type="text" class="form-control me-2 funcion" value="<?= htmlspecialchars($submenu['url']) ?>" id="inputFuncionSubmenu<?= $submenu['id'] ?>">
                                            <button class="btn btn-outline-success btn-sm" onclick="updateApartado(<?= $submenu['id'] ?>, document.getElementById('inputNombreSubmenu<?= $submenu['id'] ?>').value, document.getElementById('inputFuncionSubmenu<?= $submenu['id'] ?>').value)">Guardar</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="hidden-div card-body mt-2" id="editForm<?= $menuItem['id'] ?>" style="display: none; background-color: #f1f8f1;">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-primary">Nuevo nombre</p>
                        <input type="text" class="form-control me-2 nuevo-nombre" value="<?= htmlspecialchars($menuItem['titulo']) ?>" id="inputNombre<?= $menuItem['id'] ?>">
                        <p class="text-primary">Función</p>
                        <input type="text" class="form-control me-2 funcion" value="<?= htmlspecialchars($menuItem['url']) ?>" id="inputFuncion<?= $menuItem['id'] ?>">
                        <button class="btn btn-outline-primary btn-sm" onclick="updateApartado(<?= $menuItem['id'] ?>, document.getElementById('inputNombre<?= $menuItem['id'] ?>').value, document.getElementById('inputFuncion<?= $menuItem['id'] ?>').value)">Guardar</button>
                    </div>
                </div>

                <div class="hidden-div card mt-2" style="display: none; background-color: #f9fdf9; border: 1px dashed #007bff;" id="subMenu<?= $menuItem['id'] ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="text-primary">Nombre</p>
                            <input type="text" class="form-control me-2 nuevo-nombre" placeholder="Nuevo nombre de apartado">
                            <p class="text-primary">Función</p>
                            <input type="text" class="form-control me-2 funcion" placeholder="Función del apartado">
                            <button class="btn btn-outline-primary btn-sm" onclick="crearNuevoApartado(this, <?= $menuItem['posicion'] ?>, <?= $menuItem['id'] ?>)">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="hidden-div card mt-2" style="display: none; background-color: #f1f8f1; border: 1px dashed #28a745;" id="subMenuUltimo">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-success">Nombre</p>
                <input type="text" class="form-control me-2 nuevo-nombre" placeholder="Nuevo nombre de apartado">
                <p class="text-success">Función</p>
                <input type="text" class="form-control me-2 funcion" placeholder="Función del apartado">
                <button class="btn btn-outline-success btn-sm" onclick="crearNuevoApartado(this, <?= count($datos) + 1 ?>, null)">Guardar</button>
            </div>
        </div>
    </div>
</div>
