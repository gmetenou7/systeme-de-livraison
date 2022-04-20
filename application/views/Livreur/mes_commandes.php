<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-primary">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('index.php/accueil') ?>" class="nav-link">Home</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown ">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell notification-icon"></i>
                    <span class="badge badge-danger navbar-badge"></span>
                </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item notification_content"></a>
                    <span class="dropdown-item error"></span>
                    </div>
            </li>
        </ul>
    </nav>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mes Commandes</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <th>Code Commande</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </thead>
                                <tbody class="contenu">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="details_com_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <span class="contentdetail"></span>
                <hr>
                <h6>article(s) commandé(s)</h6>
            <span class="articledetail"></span>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        mes_commandes();
        //affiche les commandes du livreur 
        function mes_commandes() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/get-commande') ?>",
                dataType: "JSON",
                success: function (data) {
                    $('.contenu').html(data.result)
                }
            });
        }
         //détails d'une commande
         $(this).on('click', '.details_co', function () {
            var code_com = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/details') ?>",
                data: {code_com:code_com},
                dataType: "JSON",
                success: function (response) {
                    $('.contentdetail').html(response.resultat);
                    $('.articledetail').html(response.article);
                }
            });
        });
        /**
         * Affiche les notifications d'un livreur
         */
        function show_notifications() { 
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/notifications') ?>",
                dataType: "JSON ",
                success: function (data) {
                    var datas = [data]
                    var s = JSON.stringify(datas[0].notif);
                    var count = JSON.parse(s)
                    if (count >= 1) {
                        $('.notification_content').html(data.resultat)
                        $('.navbar-badge').html(data.notif)
                    }else{
                        $('.error').html(data.error)
                    }
                }
            });
        }
        show_notifications()
        $(this).on('click', '.notification-link', function () {
            //on récupère le code de la commande contenu dans la requête
            var notif_code_com =  $(this).attr('id');
                Swal.fire({
                    title: 'Confirmez vous la prise en charge de cette commande?',
                    icon: 'question',
                    showConfirmationButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                    cancelButtonText:'Non'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //on récupère le code de la commande 
                        var code_com_liv = notif_code_com
                        $.ajax({
                            type: "POST",
                            url: '<?= base_url('index.php/ajout-commande') ?>',
                            data: {code_com_liv:code_com_liv},
                            dataType: "JSON",
                            success: function (data) {   

                                Swal.fire(
                                    'Cette commande a été ajouté à votre historique',
                                    '',
                                    'success'
                                ) 

                            }
                        });
                        setInterval('location.reload()', 1000);
                    }
                })
        });
    });
    
</script>