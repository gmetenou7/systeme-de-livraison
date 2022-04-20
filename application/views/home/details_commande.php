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
              <li class="breadcrumb-item"><a href="<?= base_url().'commandes' ?>">Accueil</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     <!-- Main content -->
     <section class="content">
         <div class="row">
             <div class="col-md-12">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <th>id</th>
                        <th>Désignation</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Prix TTC</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php foreach($produits->result_array() as $produit): ?>
                        <tr>
                        <td><?= $produit['id_prod'] ?></td>
                        <td><?= $produit['nom_pro'] ?></td>
                        <td><?= $produit['quantite'] ?></td>
                        <td><?= $produit['prix_u'] ?></td>
                        <td><?= ($produit['quantite'] * $produit['prix_u']) ?></td>
                        <td>
                            <div class="btn-group btn-group-md">
                            <a href="" class="btn btn-info">
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
         </div>
     </section>
</div>