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
        <h3 class="card-title">Inserer Commandes</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
       <body>
        <div class="">
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br>
                    <form id="demo" data-parsley-validate="" class="form-horizontal form-label-left" method="POST" action="<?php echo base_url('index.php/insert');?>">
                      <table>
                        <tr>
                          <th>Nom Produit</th>
                          <th>Description</th>
                          <th>Quantité</th>
                          <th>Prix</th>
                          <th>Entreprise</th>
                          <th>Id client </th>
                          <th>&nbsp&nbsp TVA</th>
                          <th>status</th>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-group rec-element">
                                <input type="text" name="nom_pro[]" id="nom_pro1" alt="1" class="form-control" placeholder="Libellé">
                            </div> 
                          </td>
                          <td>
                            <div class="form-group">
                                <input type="text" name="description[]" id="description1" alt="1" class="form-control" placeholder="Description">
                            </div>        
                          </td>
                          <td>
                            <div class="form-group">
                                <input type="text" name="quantite[]" id="quantite1" alt="1" class="form-control" placeholder="Quantité">
                            </div> 
                          </td>
                          <td>
                            <div class="form-group">
                                <input type="text" name="prix[]" id="prix" alt="1" class="form-control" placeholder="Prix">
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                                <select name="entreprise[]" class="form-control">
                                  <?php foreach ($entreprises as $entreprise):?>
                                  <option><?= $entreprise['id_en']?></option><span>(<?= $entreprise['nom_en']?>)</span>
                                  <?php endforeach ?>
                                </select>
                            </div>
                          </td>  
                          <!--<td>
                            <div class="form-group">
                                <input type="text" name="nom_cli[]" id="nom_cli" alt="1" class="form-control" placeholder="Nom client">
                            </div> 
                          </td> -->
                          <td>
                            <div class="form-group">
                                <select name="id_client[]" class="form-control">
                                  <?php foreach ($clients as $client):?>
                                  <option><?= $client['id_cli']?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>  
                          </td>
                          <td>
                            <div class="form-group">
                                <select name="tva[]" class="form-control">
                                  <option></option>
                                  <option>20</option>
                                  <option>30</option>
                                </select>
                            </div>  
                          </td>
                          <td>
                            <div class="form-group">
                                <select name="status[]" class="form-control">
                                  <?php foreach ($status as $stat):?>
                                  <option><?= $stat['id_etat']?></option><span>(<?= $stat['nom_etat']?>)</span>
                                  <?php endforeach ?>
                                </select>
                            </div>  
                          </td>
                          <td>
                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="button" class="btn btn-info plus fa fa-plus"></button>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </table> 
                      <div class="ln_solid"></div> 
                      <div id="nextkolom" name="nextkolom"></div>
                      <button type="button" id="cache" value="1" style="display:none"></button>
                      <button type="submit" class="btn btn-success">Ajouter</button>
                    </form>
                  </div>
                </div>
              </div>   
          </div>
        </div>
       </body>
      </div>
      <!-- /.card-body -->
    </div>      
  </div>
</div>
<script>
 $(document).ready(function() {
    var i=2;
    $(".plus").on('click', function(){        
        row ='<div class="rec-element">'+
                '<table>'+
                  '<tr>'+
                    '<td>'+
                      '<div class="form-group">'+
                        '<input type="text" name="nom_pro[]" id="nom_pro'+i+'" alt="'+i+'" class="form-control" placeholder="Libellé">'+
                      '</div>'+
                    '</td>'+ 
                    '<td>'+  
                      '<div class="form-group">'+
                              '<input type="text" name="description[]" id="description'+i+'" alt="'+i+'" class="form-control" placeholder="Description">'+
                      '</div>'+
                    '</td>'+
                    '<td>'+
                      '<div class="form-group">'+                         
                          '<div class="input-group">'+
                            '<input type="text" name="quantite[]" id="quantite'+i+'" alt="'+i+'" class="form-control" placeholder="quantité">'+
                          '</div>'+
                        '</div>'+
                    '</td>'+ 
                    '<td>'+
                      '<div class="form-group">'+                         
                          '<div class="input-group">'+
                            '<input type="text" name="prix[]" id="prix'+i+'" alt="'+i+'" class="form-control" placeholder="Prix">'+
                          '</div>'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<div class="form-group">'+
                            '<select name="entreprise[]" class="form-control">'+
                              <?php foreach ($entreprises as $entreprise):?>
                                '<option><?= $entreprise['id_en']?></option>'+
                              <?php endforeach ?>
                            '</select>'+
                      '</div>'+
                    '</td>'+
                      /*'<td>'+
                      '<div class="form-group">'+                         
                          '<div class="input-group">'+
                            '<input type="text" name="nom_cli[]" id="nom_cli'+i+'" alt="'+i+'" class="form-control" placeholder="Nom Client">'+
                          '</div>'+
                        '</div>'+
                    '</td>'+*/
                    '<td>'+
                      '<div class="form-group">'+                         
                          '<div class="input-group">'+
                            '<select name="id_client[]" id="id_client'+i+'" alt="'+i+'" class="form-control">'+
                              <?php foreach ($clients as $client): ?>
                                '<option>'+<?= $client['id_cli']?>+'</option>'+
                              <?php endforeach ?> 
                          '</select>'+
                          '</div>'+
                      '</div>'+
                    '</td>'+ 
                    '<td>'+
                      '<div class="form-group">'+                         
                          '<div class="input-group">'+
                              '<select name="tva[]" id="tva'+i+'" alt="'+i+'" class="form-control">'+
                                  '<option>'+'</option>'+
                                  '<option>'+ 20 +'</option>'+
                                  '<option>'+ 30 +'</option>'+
                              '</select>'+
                          '</div>'+
                    '</td>'+ 
                    '<td>'+
                        '<div class="form-group">'+
                            '<select name="status[]" class="form-control">'+
                              <?php foreach ($status as $stat):?>
                                '<option><?= $stat['id_etat']?></option>'+
                              <?php endforeach ?>
                            '</select>'+
                      '</div>'+
                    '</td>'+
                    '<td>'+
                      '<div class="form-group">'+
                        '<span class="input-group-btn" &nbsp>'+
                          '<button type="button" class="btn btn-danger del-element glyphicon glyphicon-plus"><i class="fa fa-minus-square"></i></button>'+
                        '</span>'+
                      '</div>'+
                    '</td>'+ 
                  '<div class="ln_solid"></div>'+
                '</tr>'+
              '</table>'+
            '</div>';
        $(row).insertBefore("#nextkolom");
        $('#cache').val(i+1);
        i++;         
    });
    $(document).on('click','.del-element',function (e) {        
        e.preventDefault()
        i--;
        //$(this).parents('.rec-element').fadeOut(400);
        $(this).parents('.rec-element').remove();
        $('#cache').val(i-1);
    }); 
    
   $(this).on('click', ".tva", function (){

    alert('ok')
  });

 });
</script>