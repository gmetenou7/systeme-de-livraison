<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('index.php/admin') ?>" class="nav-link">Accueil</a>
            </li>
        </ul>
    </nav>    
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Liste des Clients</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <a class="btn btn-primary mt-3 text-right" data-toggle="modal" data-target="#add_client_modal">Ajouter un Client</a>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Id</th>
                                            <th>Nom</th>
                                            <th>Adresse Email</th>
                                            <th>Téléphone</th>
                                            <th>Adresse</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($clients as $key => $client): ?>
                                                <tr>
                                                    <td><?= $client['id_cli'] ?></td>
                                                    <td><?= $client['nom_cli'] ?></td>
                                                    <td><?= $client['email_cli'] ?></td>
                                                    <td><?= $client['phone_cli'] ?></td>
                                                    <td><?= $client['adresse'] ?></td>
                                                    <td> 
                                                        <a href="#" class="btn btn-primary modifier" data-toggle="modal" id="<?= $client['id_cli'] ?>" data-target="#edit_client_modal">Modifier</a> 
                                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="">Supprimer</a> 
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Add Client  Modal -->
<div class="modal fade" id="add_client_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Ajouter un client</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
        
        
        <form action="<?= base_url('index.php/liste-des-clients')?>" method="post">
            <!-- Modal body -->
            <div class="modal-body">
                
                    <div class="form-group">
                        <label for="">Nom:</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="<?= set_value('nom') ?>">
                        <small class="text-danger"><?= form_error('nom'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Entrer une adresse email" value="<?= set_value('email') ?>">
                        <small class="text-danger"><?= form_error('email'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="text" class="form-control" name="telephone" id="téléphone" placeholder="Entrer un numéro DE téléphone" value="<?= set_value('telephone') ?>">
                        <small class="text-danger"><?= form_error('telephone'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="quantite">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Entrer un nombre ex:0, 1,...." value="<?= set_value('quantity') ?>">
                        <small class="text-danger"><?= form_error('adresse'); ?></small>
                    </div>
                
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info" name="valider" id="valider">Valider</button>
                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- Edit Client Modal -->
<div class="modal fade" id="edit_client_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modifier un client</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            
            <form action="<?= base_url('index.php/liste-des-clients')?>" method="post">
                <!-- Modal body -->
                <div class="modal-body">
                    <span class="resultat"></span>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" name="valider" id="modifier">Modifier</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    $(document).ready(function () {
       
        $('.modifier').on('click', function () {
           var id_cli =  $(this).attr('id')
           $.ajax({
                type: "GET",
                url: "<?= base_url('index.php/edit-client/{id_cli}')?>",
                data: {id_cli:id_cli},
                dataType: "JSON",
                success: function (data) {
                   $('.resultat').html(data.resultat)
                }
            });
        });
        function edit_client(id) { 
            
        }
    });
</script>