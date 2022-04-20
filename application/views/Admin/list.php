<div class="-wrapper">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-primary">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<>" class="nav-link"></a>
            </li>
        </ul>
    </nav>
    <div class="content-wrapper">
     <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Liste de Produits</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- Voir Commande Modal -->
      <div id="imprime">
        <div class="modal" id="details_com_modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Détails Commande</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <span class="contentdetail"></span>
                      <hr>
                      <h6>article(s) commandé(s)</h6>
                      <span class="contenu"></span>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="impression">valider</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      </div>
        <!-- /.modal -->
        <div class="card-body">
         <body>
          <div class="row">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <span id="content"></span>
              <table class="table table-hover text-nowrap table-hover">
                <thead>
                  <tr>
                    <th>Nom Produit</th> 
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>TVA</th>
                    <!-- <th>Nom Client</th> -->
                    <th>&nbsp &nbsp &nbsp Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php if(is_array($produits)):?>
                  <?php foreach($produits as $produit):?>
                    <tr>
                      <td><?= $produit['id_prod']?></td>
                      <td><?= $produit['nom_pro']?></td>
                      <td><?= $produit['description']?></td>
                      <td><?= $produit['quantite']?></td>
                      <td><?= $produit['prix_u']?></td> 
                      <td><?= $produit['tva']?> %</td>
                      <!-- <td><?= $produit['nom_cli']?></td> -->
                      <td>
                        <a href="<?php echo base_url('index.php/edit_pro')?>/<?= $produit['id_prod']?>" class="btn btn-warning"> <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-primary imprime" id="<?=$produit['code_cli']?>"> 
                          <i class="fas fa-file-invoice"></i>
                        </a>
                        <a href="<?php echo base_url('index.php/delete_prod')?>/<?= $produit['id_prod']?>" class="btn btn-danger ">
                          <i class="fas fa-remove"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>  
        </body>   
      </div>
    </div>
  </div>

<script>
$(document).ready(function () {

/*$(this).on( "click", ".imprime", function() {
      var code = $(this).attr("id");
      $.ajax({
      method: "POST",
      url: "<//php echo base_url('prodclient'); ?>",
      data: {code:code},
      dataType: "json",
      success: function (data) {
        if(data.resultat){
          $(".contenu").html(data.resultat);
        } 
      }
    });
  });*/

  $(this).on('click', ".imprime", function (){
    //on récupère le code du produit
    var code = $(this).attr('id');
    window.location.href = "<?= base_url('index.php/prodfact/');?>"+code;
    
  }); 
})
</script>