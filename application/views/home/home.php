<div class="wrapper" >
  <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('index.php/home') ?>" class="nav-link">Home</a>
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
                  <a href="#" class="dropdown-item notification_content error">
                  </a>
                </div>
            </li>
        </ul>
  </nav>
  <div class="content-wrapper">
    <?= session('notification') ?>
    <!-- Content Header (Page header) -->
    <?php $this->load->view('assets/messages') ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Statistique Livraison</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Statistique</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form class="filter_en">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Filtrez par entreprise</label>
                          <select class="form-control" id="entreprise" name="entreprise"  style="width: 100%;">
                          <?php foreach ($entreprises as $entreprise): ?>
                            <option value="<?= $entreprise['id_en'] ?>" ><?= $entreprise['nom_en'] ?></option>
                          <?php endforeach ?>
                          </select>
                      </div>
                    </div>
                    <div class="">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                      </div>
                    </div>
                  </div>
                </form>
                <div>
                  <?php if(!$histo): ?>
                      <?= $error ?>
                  <?php endif ?>
                  <canvas id="doughnut_chart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Historique -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h2>Historique</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="pill" href="#Encours" role="tab" aria-controls="home" aria-selected="true">Encours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="pill" href="#Livre" role="tab" aria-controls="profile" aria-selected="false">Livré</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="messages-tab" data-toggle="pill" href="#Nonlivre" role="tab" aria-controls="messages" aria-selected="false">Non Livré</a>
            </li>
          </ul>
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="Encours" role="tabpanel" aria-labelledby="home-tab">
              <table class="table table-hover table-bordered text-nowrap">
                <!-- input de recherche-->
                <input type="text" class="form-control statut"  id="recherche" name="search_text" style="width: 100%;" placeholder="Search ...">
                <span id="content"></span>
              </table>
            </div>
            <div class="tab-pane fade" id="Livre" role="tabpanel" aria-labelledby="profile-tab">
              <table class="table table-hover table-bordered text-nowrap">
                <!-- input de recherche-->
                <input type="text" class="form-control statut"  id="recherchli" name="search_text" style="width: 100%;" placeholder="Search ...">
                <span id="content_livre"></span>
              </table>
            </div>
            <div class="tab-pane fade" id="Nonlivre" role="tabpanel" aria-labelledby="messages-tab">
              <table class="table table-hover table-bordered text-nowrap">
                <!-- input de recherche-->
                <input type="text" class="form-control statut"  id="cherchlannul" name="search_text" style="width: 100%;" placeholder="Search ...">
                <span id="content_annuler"></span>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
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
                <span class="articledetail"></span>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="impression" onClick="imprimer('imprime')">Imprimer</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
</div>
<!-- /.modal -->
<!-- Modal du code de la facture -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Code de la facture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" id="recipient-name">
              <span class="text-danger" id="error-code"></span>
            </div>
            <div class="form-group">
              <input type="text" name="" id="sign" class="form-control" hidden >
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary next" data-toggle="modal"  data-whatever="@mdo">Next</button>
        </div>
    </div>
  </div>
</div>
<!-- Modal de la signature -->
<div class="modal fade" id="signature" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Signature</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-submit" method="POST">
          <div class="form-group">
            <div class="mise-en-page">
              <div class="bloc-mise-en-page">
                <h6>Signez ici &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
                  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp
                  &nbsp &nbsp &nbsp &nbsp 
                  <button id="clear" class="btn btn-sm btn btn-danger">Effacer</button>
                </h6>
                <div class="wrapper sig">
                  <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                </div>
              </div>
              <textarea type="text" id='signature-result' name="signature-result" hidden=""></textarea>
              <span id="sign-error" class="text-danger"></span>
              <!--<img src="" id="signature-img-result" />-->
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit " id="valider" class="btn btn-success clear" >Valider</button>      </div>
    </div>
    </form>
  </div>
</div>
<script>
  // function pour imprimer la commande
  function imprimer(imprime) {
      var printContents = document.getElementById("imprime").innerHTML;    
       var originalContents = document.body.innerHTML;      
       document.body.innerHTML = printContents;     
       window.print();
       document.body.innerHTML = originalContents;
    }
  $(document).ready(function () {
    //filtrer les statistiques en fonction des entreprises
    $('.filter_en').submit(function (e) { 
      e.preventDefault();
      var code = $('#entreprise').val();
      window.location.href = "<?= base_url('index.php/home/');?>"+code;
    });
    /**Reception d'une commnande début */
    $(this).on( "click", ".recep_co", function() {
      var code = $(this).attr("id");
        $("#exampleModal").modal('show');
        $('.next').click(function (e) { 
          e.preventDefault();
          /**on  récupère le code saisit */
          var bla = $('#recipient-name').val();
          /**on vérifie le code */
          $.ajax({
            type: "POST",
            url: "<?= base_url('index.php/confirm') ?>",
            data: {bla:bla, code:code},
            dataType: "json",
            success: function (data) {
              if (data.champ) {
                  $("#exampleModal").modal('hide');
                  $("#signature").modal('show');
                } else {
                  $('#error-code').html(data.error)
                }
            }
          });
          /**on soumet la commande avec la signature */
          $('#form-submit').submit(function (e) { 
            e.preventDefault();
            var signature = $('#signature-result').val();
            $.ajax({
              type: "post",
              url: "<?= base_url('index.php/signature') ?>",
              data: {bla:bla, signature:signature},
              dataType: "json",
              success: function (data) {
                if (data.result) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Félicitations ',
                    text: 'Votre commande a bien été livré',
                  });
                  $("#signature").modal('hide');
                  listcommande();
                }
              }
            });
          });
        });
      
      
    });
    /**Reception d'une commnande fin */
    /**suivi d'une commande début*/
    function suiviCommande(){
      function maPosition(position) {
        //on récupère la latitude et la longitude du client
          var infoposla = position.coords.latitude +"\n";
          var infoposlon = position.coords.longitude+"\n";
        //la position du livreur (premice computer par défaut , )
        var latPremice = 3.8669534924655364;
        var longPremice = 11.522875811921292
        //on met les coordonnées du client dans la carte
          //window.location.href='https://www.google.com/maps/@'+infoposla+','+infoposlon+',15z';
          window.location.href='https://www.google.com/maps/dir/'+latPremice+','+longPremice+'/'+infoposla+',+'+infoposlon+'/@'+infoposla+','+infoposlon+',18z/data=!3m1!4b1!4m8!4m7!1m1!4e1!1m3!2m2!1d11.5200056!2d3.8676547!3e0'
      }

          if(navigator.geolocation)
              navigator.geolocation.getCurrentPosition(maPosition);
    }
    
    $(this).on('click', ".suivi_co", function () {
      //on récupère le code de la commande
      var code = $(this).attr('id');
      window.location.href = "<?= base_url('index.php/suivi-commande/');?>"+code;
      
    });
    /**suivi d'une commande fin*/
    /** suppression d'une commande*/  
      $(this).on("click", ".delateCom", function () { 
        Swal.fire({
            title: 'Annuler la Commande ?',
            text: "Vous ne pourriez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true,// annulerCom
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Valider!'
        }).then((result) => {
            if (result.isConfirmed) {
                var code = $(this).attr('id');
                  $.ajax({
                    url:"<?php echo base_url('index.php/delete_com');?>",
                    method:"POST",
                    data: {code:code},
                    success:function(data){
                      Swal.fire(
                          'Annulé!',
                          'Commande annulée',
                          'success'
                      )
                      listcommande();
                    }
                  })
            }
        })
    });

    
    // afficher liste de commande encours
    $.ajax({
      method: "get",
      url: "<?php echo base_url('index.php/get_comEncours'); ?>",
      success: function(data){
          $("#content").html(data);
      }
    });  
    // afficher liste de commande livrées
    $.ajax({
      method: "get",
      url: "<?php echo base_url('index.php/comLivre'); ?>",
      success: function(data){
          $("#content_livre").html(data);
      }
    });  
    
    // afficher liste de commande non livrées(annulées)
    $.ajax({
      method: "get",
      url: "<?php echo base_url('index.php/get_Comannuler'); ?>",
      success: function(data){
          $("#content_annuler").html(data);
      }
    });

    /**details d'un commande debut */
    $(this).on( "click", ".details_co", function() {
      var mat = $(this).attr("id");
      $.ajax({
        method: "POST",
        url: "<?php echo base_url('index.php/details_commande'); ?>",
        data: {mat:mat},
        dataType: "json",
        success: function (data) {
          if(data.resultat){
            $(".contentdetail").html(data.resultat);
            $(".articledetail").html(data.article);
            $("#details_com_modal").modal('show');
          } 
        }
      });
    });

      chart();
    /**affiche les statistiques d'historique début */
    function chart() { 
      var cData = JSON.parse('<?= $chart_data ?>')
      var chart_data = {
        labels:cData.label,
        datasets: [
            {
              label: cData.label,
              data: cData.data,
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
          ]
      };

      var options = {
          responsive:true,
          scales:{
              yAxes:[{
                  ticks:{
                      min:0
                  }
              }]
          }
      };
      new Chart($('#doughnut_chart'), {
            type:"doughnut",
            data:chart_data
      });
    }

    /**afficher la liste de toutes les commandes debut */
    listcommande();
    function listcommande(){
      $.ajax({
        method: "GET",
        url:"<?php echo base_url('index.php/allcommande')?>",
        dataType: "json",
        success:function(data){
          if(data.result){
            $('.contenu').html(data.result);
          }
        }
      })
    }
    cherche();
	  function cherche(query)
	    {
		    $.ajax({
			    url:"<?php echo base_url('index.php/recherche');?>",
			    method:"POST",
			    data:{query:query},
			    success:function(data){
				    $('#content').html(data);
			    }
		    })
	    }

	    $('#recherche').keyup(function(){
		    var search = $(this).val();
		    if(search != '')
		    {
			    cherche(search);
		    }
		    else
		    {
			    cherche();
		    }
	    });

    //rechercher dans l'historique pour commande livrée
    cherchli();
	    function cherchli(query)
	    {
		    $.ajax({
			    url:"<?php echo base_url('index.php/recherchli');?>",
			    method:"POST",
			    data:{query:query},
			    success:function(data){
				    $('#content_livre').html(data);
			    }
		    })
	    }

	    $('#recherchli').keyup(function(){
		    var search = $(this).val();
		    if(search != '')
		    {
			    cherchli(search);
		    }
		    else
		    {
			    cherchli();
		    }
	    });

      // recherche dans l'historique les commandes annulées'
      cherchlannul();
      function cherchlannul(query)
	    {
		    $.ajax({
			    url:"<?php echo base_url('indexphp/recherchannul');?>",
			    method:"POST",
			    data:{query:query},
			    success:function(data){
				    $('#content_annuler').html(data);
			    }
		    })
	    }
	    $('#cherchlannul').keyup(function(){
		    var search = $(this).val();
		    if(search != '')
		    {
			    cherchlannul(search);
		    }
		    else
		    {
			    cherchlannul();
		    }
	    });
          
    // afficher les commandes encours dans l'historique  
    $.ajax({
      method: "get",
      url: "<?php echo base_url('index.php/get_comEncours'); ?>",
      success: function(data){
          $("#content").html(data);
      }
    });
    //Notifications 
    function show_notifications() { 
      $.ajax({
        type: "POST",
        url: "<?= base_url('index.php/show-notifications') ?>",
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
    
    //notification en différé  
    $(this).on("click", '.notification', function () {
      Swal.fire({
        title: 'Souhaitez vous confirmer la livraison  cette commande?',
        icon: 'question',
        showConfirmationButton: true,
        showCancelButton: true,
        confirmButtonText: 'Confirmer',
        cancelButtonText:'Annuler'
      }).then((result) => {
        if(result.isConfirmed){
          var c = $('.notification').attr('id')
          var notif_liv = "La Commande est prête à être livrer. Veuillez Cliquez sur ce message pour prendre en charge la commande";
          $.ajax({
            type: "POST",
            url: "<?= base_url('index.php/update-status') ?>",
            data: {c:c, notif_liv:notif_liv},
            success: function (data) {
              Swal.fire(
                  'Bravo',
                  'Votre commande vous sera livré dans les délais impartis',
                  'success'
              )
              show_notifications()
              listcommande();
              setInterval('location.reload()', 1000); 
            }
          });
        }
      })
    });
    
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })

    
  });
</script>