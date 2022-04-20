
<div class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Premice</b>Computer</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Connectez Vous pour accédez à votre compte</p>
                <form action="<?= base_url()?>connexion" method="post">
                    <span class="text-danger"><?= $message ?></span>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value('email') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <?= '<span class="text-danger">'.form_error('email').'</span>' ?>
                    <span class="text-danger"><?= $pass ?></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?= set_value('password') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?= '<span class="text-danger">'.form_error('password').'</span>' ?>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="connexion" class="btn btn-primary btn-block">Connexion</button>
                            
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            <p class="mb-1">
                <a href="<?= base_url().'mot-de-passe-oublie' ?>">Mot de passe oublié</a>
            </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>