<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$title?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url() . 'liste-des-commandes'?>">Accueil</a></li>
              <li class="breadcrumb-item active"><?=$title?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Modifier commande</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEstimatedBudget">Désignation</label>
                            <input type="text" id="inputEstimatedBudget" class="form-control" step="1" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputSpentBudget">Quantité</label>
                            <input type="number" id="inputSpentBudget" class="form-control"  step="1">
                        </div>
                        <div class="form-group">
                            <label for="inputEstimatedDuration">Prix Hors Taxe</label>
                            <input type="text" id="inputEstimatedDuration" class="form-control"  step="0.1" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputEstimatedDuration">Prix TTC</label>
                            <input type="text" id="inputEstimatedDuration" class="form-control"  step="0.1" readonly>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <button type="submit" class="btn btn-danger">Annuler</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
</div>