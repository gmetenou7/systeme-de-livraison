<!-- Main Sidebar Container -->
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url('public/img/logo/premice.png') ?>" alt="Premice Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Premice Computer</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <?php if(session('user')): ?>
            <a href="#" class="d-block"><?= session('user')['nom_user'] ?></a>
          <?php elseif(session('client')): ?>
              <a href="#" class="d-block"><?= session('client')['nom_cli'] ?></a>
          <?php endif?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <?php if(session('client')): ?>
            <li class="nav-item">
              <a href="<?=  base_url('index.php/home') ?>" class="nav-link <?php if($this->uri->segment(1)=="home"){echo "active";}?>">
                <i class="fa fa-bar-chart" style="font-size:20px"></i>
                <p>
                  Statistique Livraison
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=  base_url('index.php/commande') ?>" class="nav-link <?php if($this->uri->segment(1)=="commande"){echo "active";}?>">
                <i class="fas fa-clipboard-list"></i>
                <p>
                  Commande
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#myModal">
                <i class="fal fa-history"></i>
                <p>
                  Historique
                </p>
              </a>
            </li>
          <?php elseif(session('user')): ?>
            <li class="nav-item">
              <a href="<?=  base_url('index.php/accueil') ?>" class="nav-link <?php if($this->uri->segment(1)=="accueil"){echo "active";}?>">
                <i class="fas fa-clipboard-list"></i>
                <p>
                  Commande Syst??me
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=  base_url('index.php/mes-commandes') ?>" class="nav-link <?php if($this->uri->segment(1)=="mes-commandes"){echo "active";}?>">
                <i class="fas fa-clipboard-list"></i>
                <p>
                  Mes Commandes
                </p>
              </a>
            </li>
          <?php endif ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
      <a href="<?php echo site_url('index.php/deconnexion'); ?>" class="btn btn-secondary hide-on-collapse pos-right">Deconnexion</a>
    </div>
    <!-- /.sidebar-custom -->
  </aside>