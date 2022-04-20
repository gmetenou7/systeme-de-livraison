<div class="col d-flex justify-content-center mt-3">
    <div class="register-box">
        <div class="register-logo">
            <b>Premice</b>Livraison
        </div>
        
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Créer votre compte</p>

                <form action="<?= base_url('index.php/inscription') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nom" placeholder="Nom & Prénoms" value="<?=  set_value('nom') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?=  form_error('nom') ?></span>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?=  set_value('email') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?=  form_error('email') ?></span>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="tel" placeholder="N° Téléphone" value="<?=  set_value('tel') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?=  form_error('tel') ?></span>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="entreprise" placeholder="Nom de votre entreprise" value="<?=  set_value('entreprise') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?=  form_error('entreprise') ?></span>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="secteur" placeholder="Votre Secteur Activité" value="<?=  set_value('secteur') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?=  form_error('secteur') ?></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="mdp" placeholder="Mot de passe">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?=  form_error('mdp') ?></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="mdp_conf" placeholder="Confirmé mot de passe" value="<?=  set_value('mdp') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?=  form_error('mdp_conf') ?></span>
                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    J'accepte les <a href="#">termes et conditions</a>
                                </label>
                            </div>
                            <span class="text-danger"><?=  form_error('terms') ?></span>
                        </div>
                        
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" name="inscription">Inscrivez vous</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="<?= base_url() ?>" class="text-center">Vous possedez déjà un compte cliquez sur ce lien pour vous connectez</a>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.register-box -->
</div>