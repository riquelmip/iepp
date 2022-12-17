    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres'] ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol'] ?></p>
        </div>
      </div>
      <ul class="app-menu">
      <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/" target="_blank">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Ir a Pagina Web</span>
            </a>
        </li>
        <?php if (!empty($_SESSION['permisos'][1]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users" aria-hidden="true"></i>
                    <span class="app-menu__label">Usuarios</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/Himnario">
                    <i class="app-menu__icon fa fa-book" aria-hidden="true"></i>
                    <span class="app-menu__label">Himnario de Alabanzas</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/Alabanzas">
                    <i class="app-menu__icon fa fa-bars" aria-hidden="true"></i>
                    <span class="app-menu__label">Cancionero de Alabanzas</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][10]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-music" aria-hidden="true"></i>
                    <span class="app-menu__label">Coros</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Coros/CorosAv"><i class="icon fa fa-circle-o"></i> Avivamiento</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Coros/CorosAd"><i class="icon fa fa-circle-o"></i> Adoración</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-music" aria-hidden="true"></i>
                    <span class="app-menu__label">Cadenas de Coros</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Cadenas/CadenasAv"><i class="icon fa fa-circle-o"></i> Avivamiento</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Cadenas/CadenasAd"><i class="icon fa fa-circle-o"></i> Adoración</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/pedidos">
                    <i class="app-menu__icon fa fa-file-alt" aria-hidden="true"></i>
                    <span class="app-menu__label">Partituras para Saxofón</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][7]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/clientes">
                    <i class="app-menu__icon fa fa-file-word" aria-hidden="true"></i>
                    <span class="app-menu__label">Reportes de Ofrenda</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][8]['r'])) { ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-music" aria-hidden="true"></i>
                    <span class="app-menu__label">Privilegios</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Privilegios"><i class="icon fa fa-circle-o"></i> Privilegios Cultos Directivas</a></li>
                    <?php if ($_SESSION['idRolUser'] == 1 || $_SESSION['idRolUser'] == 2) { ?>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Privilegiosdomingos"><i class="icon fa fa-circle-o"></i> Privilegios Culto Dominical</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Privilegios/GruposAseo"><i class="icon fa fa-circle-o"></i> Grupos de Aseo</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/Privilegios/GruposFlores"><i class="icon fa fa-circle-o"></i> Grupos de Flores</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][9]['r'])) { ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/Predicas">
                    <i class="app-menu__icon fa fa-file-word" aria-hidden="true"></i>
                    <span class="app-menu__label">Predicas</span>
                </a>
            </li>
        <?php } ?>
        
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Cerrar Sesion</span>
            </a>
        </li>
      </ul>
    </aside>