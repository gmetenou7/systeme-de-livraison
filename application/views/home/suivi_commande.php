<?php

//call api
$url = file_get_contents("http://www.geoplugin.net/json.gp?ip=");

//decode json data
$getInfo = json_decode($url); 

$client_lat = $getInfo->geoplugin_latitude;
$client_long = $getInfo->geoplugin_longitude;
$livreur_lat = $getInfo->geoplugin_latitude;
$livreur_long= $getInfo->geoplugin_longitude;

$distance = round(get_distance_m($client_lat,$client_long,$livreur_lat, $livreur_long) / 1000,3);


// calcul de la distance en mètres entre le client et le livreur
function get_distance_m($lat1, $lng1, $lat2, $lng2) {
  $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
  $rlo1 = deg2rad($lng1);
  $rla1 = deg2rad($lat1);
  $rlo2 = deg2rad($lng2);
  $rla2 = deg2rad($lat2);
  $dlo = ($rlo2 - $rlo1) / 2;
  $dla = ($rla2 - $rla1) / 2;
  $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
  $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
  return round(($earth_radius * $d));
}

?>
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-dark bg-primary">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<>" class="nav-link">Home</a>
            </li>
        </ul>
    </nav>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Suivi de commande</h1>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Détails Commande</h3>
                            </div>
                            <div class="card-body">
                                <ol class="list-group list-group-numbered text-black">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"></div>
                                            Code Commande
                                        </div>
                                        <span><?= $commandes["code_com"] ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold"></div>
                                            Etat Commande 
                                        </div>
                                        <?php if(($commandes['etat_com'])==6): ?>
                                            <span class="badge badge-danger">Annulée</span>
                                        <?php elseif(($commandes['etat_com'])==5): ?>
                                            <span class="badge badge-success">Livrée</span>
                                        <?php elseif(($commandes['etat_com'])==4): ?>
                                            <span class="badge badge-second">Confirmé</span>
                                        <?php elseif(($commandes['etat_com'])==3): ?>
                                            <span class="badge badge-primary">Préparation</span>
                                        <?php elseif(($commandes['etat_com'])==2): ?>
                                            <span class="badge badge-default">Reçus</span>
                                        <?php  elseif(($commandes['etat_com'])==1):?>
                                            <span class="badge badge-warning">Encours</span>
                                        <?php else:?>
                                            <span class="badge badge-default">En attente...</span>
                                        <?php endif ?>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold"></div>
                                            Date Commande
                                        </div>
                                        <span><?= $commandes["date_com"] ?></span>
                                    </li>
                                </ol>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Désignation</th>
                                            <th>Quantité</th>
                                            <th>Prix</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($articles as $key=>$value): ?>
                                                <tr>
                                                    <td><?= $value["nom_pro"] ?></td>
                                                    <td><?= $value["quantite"]  ?></td>
                                                    <td><?= $value["prix_u"]  ?></td>
                                                </tr>
                                            <?php endforeach?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Suivi de livraison</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <span>Distance: <?= $distance ?> m</span>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?= ($distance * 100) ?>" aria-valuemin="0"
                                            aria-valuemax="100" style="width: <?= ($distance * 100) ?>%">
                                            <span><?= ($distance * 100) ?></span>
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
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
                <span id="content"></span>
              </table>
            </div>
            <div class="tab-pane fade" id="Livre" role="tabpanel" aria-labelledby="profile-tab">
              <table class="table table-hover table-bordered text-nowrap">
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
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
    $(document).ready(function () {
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