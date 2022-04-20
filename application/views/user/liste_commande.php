
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active"><?//= $title ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <h2>Bienvenue <?= session('user')['email'] ?></h2>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
               
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Encours</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Livré</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Rechercher une facture" value="">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <th>Code Facture</th>
                        <th>Nom Facture</th> 
                        <th>Nom Client</th>
                        <th>Date</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php foreach($commandes as $command): ?>
                          <tr>
                            <td><?= $command['code_facture_com'] ?></td>
                            <td><?= $command['code_facture_com'] ?></td>
                            <td><?= $command['code_user_com'] ?></td>
                            <td><?= $command['code_facture_com'] ?></td>
                            <td>
                              <div class="btn-group btn-group-md">
                                <a href="<?='#'?>" class="btn btn-info">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="" class="btn btn-danger">
                                  <i class="fas fa-trash"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table table-bordered table-striped">
                        <thead>
                          <th>Code Facture</th>
                          <th>Nom Facture</th>
                          <th>Nom Client</th>
                          <th>Date</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              <div class="btn-group btn-group-md">
                                <a href="<?='#'?>" class="btn btn-info">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="" class="btn btn-danger">
                                  <i class="fas fa-trash"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
                      <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
    </section>
</div>

