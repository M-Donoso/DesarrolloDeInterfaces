<?php if (!empty($datos)): ?>
    <div class="container-fluid" id="capaMenu">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <?php
                        // Función para obtener submenús de un menú específico
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

                        // Ordenar los datos por la posición antes de recorrerlos
                        usort($datos, function ($a, $b) {
                            return $a['posicion'] - $b['posicion'];
                        });

                        // Generar menús principales y submenús
                        foreach ($datos as $menuItem):
                            if (empty($menuItem['id_padre'])): // Menú principal
                                $submenus = obtenerSubmenus($menuItem['id'], $datos);
                        ?>
                                <?php if (!empty($submenus)): ?>
                                    <!-- Menú con submenús -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <?= htmlspecialchars($menuItem['titulo']) ?>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($submenus as $submenu): ?>
                                                <li>
                                                    <a
                                                        class="dropdown-item"
                                                        href="#"
                                                        <?= $submenu['titulo'] === 'Usuarios' ? 'onclick="' . $submenu['url'] . '"' : '' ?>>
                                                        <?= htmlspecialchars($submenu['titulo']) ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <!-- Menú sin submenús -->
                                    <li class="nav-item">
                                        <a
                                            class="nav-link"
                                            href="#"
                                            onclick="<?= htmlspecialchars($menuItem['url']) ?>">
                                            <?= htmlspecialchars($menuItem['titulo']) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid" id="capaContenido"></div>
<?php else: ?>
    <p>No hay opciones de menú disponibles.</p>
<?php endif; ?>