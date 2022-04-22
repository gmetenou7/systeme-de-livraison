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
          <?php if(session('user')['nom_user'] == 'admin'): ?>
            <a href="#" class="d-block"><?= session('user')['nom_user'] ?></a>
          <?php endif?>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php if(session('user')['nom_user'] == 'admin'):?>
            <li class="nav-item">
              <a href="<?=  base_url('index.php/admin') ?>" class="nav-link <?php if($this->uri->segment(1)=="admin"){echo "active";}?>">
                <i class="fas fa-plus"></i>
                <p>
                  Inserer Commandes
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=  base_url('index.php/liste_pro')?>" class="nav-link <?php if($this->uri->segment(1)=="liste_pro"){echo "active";}?>">
                <i class="fa fa-list-alt"></i>
                <p>
                  Liste Produits
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="<?=  base_url('index.php/liste-des-clients')?>" class="nav-link <?php if($this->uri->segment(1)=="liste-des-clients"){echo "active";}?>">
                <i class="fa fa-list-alt"></i>
                <p>
                  Liste Clients
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