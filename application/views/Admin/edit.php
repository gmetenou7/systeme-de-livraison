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
        <h3 class="card-title">Modifier</h3>
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
                    <form id="demo" data-parsley-validate="" class="form-horizontal form-label-left" method="POST" action="<?php echo base_url('index.php/update_pro');?>">
                      <?php foreach ($dataa as $data): ?>
                      <input type="hidden" name="id" value="<?php echo $data['id_prod']?>">
                        
                      <table>
                        <tr>
                          <th>Nom Produit</th>
                          <th>Description</th>
                          <th>Quantité</th>
                          <th>Prix</th>
                          <th>Nom Client</th>
                        </tr>
                        <tr>
                          <td>
                            <div class="form-group rec-element">
                                <input type="text" name="nom_pro" id="nom_pro1" alt="1" value="<?php echo $data['nom_pro']?>" required="required" class="form-control" placeholder="Libellé">
                            </div> 
                          </td>
                          <td>
                            <div class="form-group">
                                <input type="text" name="description" id="description1" alt="1" value="<?php echo $data['description']?>" required="required" class="form-control" placeholder="Description">
                            </div>        
                          </td>
                          <td>
                            <div class="form-group">
                                <input type="text" name="quantite" id="quantite1" alt="1" value="<?php echo $data['quantite']?>" required="required" class="form-control" placeholder="Quantité">
                            </div> 
                          </td>
                          <td>
                            <div class="form-group">
                                <input type="text" name="prix" id="prix" alt="1" required="required" value="<?php echo $data['prix_u']?>" class="form-control" placeholder="Prix">
                            </div>
                          </td>
                          <td>
                            <div class="form-group">
                                <input type="text" name="nom_cli" id="nom_cli" alt="1" value="<?php echo $data['code_cli']?>"required="required" class="form-control" placeholder="Nom client">
                            </div> 
                          </td>
                        </tr>
                      </table> 
                      <?php endforeach ?>
                      <div class="ln_solid"></div>
                      <div id="nextkolom" name="nextkolom"></div>
                      <button type="button" id="cache" value="1" style="display:none"></button>
                      <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
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