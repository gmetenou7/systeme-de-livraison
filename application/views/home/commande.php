<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-primary">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<>" class="nav-link">Home</a>
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
                      <a href="#" class="dropdown-item notification_content">
                      </a>
                      <a href="#" class="dropdown-item error"></a>
                    </div>
            </li>
        </ul>
    </nav>
    <?php $this->load->view('assets/messages')  ?>
    
    <div class="content-wrapper">
      <span class="client" id="<?= session('client')['nom_cli'] ?>"></span>
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Commandes</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                            <div class="card-header p-0 pt-1">
                                <h3 class="card-title" style="font-size:1.1rem;font-weight:400;margin:0">Liste des commandes</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <form id="form_filter">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Filtrez par Statut</label>
                                            <select class="form-control statut"  id="search_text" name="search_text" style="width: 100%;">
                                              <option></option>
                                              <?php foreach($etat as $eta): ?>
                                                  <option value="<?= $eta['id_etat'] ?>"><?= $eta['nom_etat'] ?></option>
                                              <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                          <label>Filtrez par Entreprise</label>
                                          <select class="form-control entreprise"  id="search_en" name="search_en" style="width: 100%;">
                                            <option></option>
                                            <?php foreach($entreprise as $entrep): ?>
                                                <option value="<?= $entrep['id_en'] ?>"><?= $entrep['nom_en'] ?></option>
                                            <?php endforeach ?>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success" id="filterall">Filtrer</button>
                                        </div>
                                    </div>
                                </div>
                              </form>
                              <span class="result">
                              </span>
                              <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Code Facture</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody class="contenu">

                                  </tbody>
                                </table>
                              </div>
                            </div> 
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            
        </section>
    </div>
</div>
<!-- Modal Historique -->
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
    var id = $('.delateCom').attr('id');
    
    /**filtrer la liste des commandes par entreprise et etat */
    $("#form_filter").submit(function( event ) {
      event.preventDefault();
      var entrep = $('#search_en').val();
      var etat = $('#search_text').val();
      
      $.ajax({
        method: "POST",
        url:"<?= base_url('index.php/filterc')?>",
        data:{etat:etat,entrep:entrep},
        dataType: "json",
        /*beforeSend: function() {
          $("#filterall").attr('disabled',true);
          $("#filterall").addClass('loading');
        },*/
        success:function(data){
          if(data.result){
            $('.contenu').html(data.result);
          }
          if(data.error){
            $('.contenu').html(data.error);
          }
        }
        //$("#filterall").attr('disabled',false);
      })

    })


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
    /**afficher la liste de toutes les commandes fin */

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
    /**details d'un commande fin */

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
              listcommande();
              setInterval('location.reload()', 1000); 
            }
          });
        }
      })
    });
    // afficher les commandes encours dans l'historique  
    $.ajax({
      method: "get",
      url: "<?php echo base_url('index.php/get_comEncours'); ?>",
      success: function(data){
          $("#content").html(data);
      }
    });  
    // afficher liste de commande livrées dans l'historique
    $.ajax({
      method: "get",
      url: "<?php echo base_url('index.php/comLivre'); ?>",
      success: function(data){
          $("#content_livre").html(data);
      }
    });  

    // afficher liste de commande non livrées(annulées) dans l'historique
    $.ajax({
      method: "get",
      url: "<?php echo base_url('index.php/get_Comannuler'); ?>",
      success: function(data){
          $("#content_annuler").html(data);
      }
    });

     //rechercher dans l'historique pour commande encours
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
			    url:"<?php echo base_url('index.php/recherchannul');?>",
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
              }else{
                $('.contenu').html(data.resultat);
              }
            }
          })
        }

        // afficher les commandes encours dans l'historique  
        $.ajax({
        method: "get",
        url: "<?php echo base_url('index.php/get_comEncours'); ?>",
        success: function(data){
            $("#content").html(data);
        }
      });  
    //
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
  });
      
  // fonction pour la signature
  $(function() {
    // init signaturepad
    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)'
    });

    // get image data and put to hidden input field
    function getSignaturePad() {
        var imageData = signaturePad.toDataURL('image/png');
        $('#signature-result').val(imageData)
        $('#signature-img-result').attr('src',"data:"+imageData);
    }

    // valider la signature 
    $('#form-submit').submit(function(event) {
        event.preventDefault();
          getSignaturePad();
    });

    // action on click button clear
    $('#clear').click(function(e) {
        e.preventDefault();
        signaturePad.clear();
    })
  });

</script>
<style type="text/css">
    .sig {
        position: relative;
        width: 400px;
        height: 200px;
        border: solid 2px #000;
        margin: 10px 0px;
    }
    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width:400px;
        height:200px;
    }
    textarea {
        width: 100%;
        min-height: 100px;
    }
</style>