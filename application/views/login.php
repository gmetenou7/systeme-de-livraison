<div class="login-page">
	<div class="login-box">
		<?php $this->load->view('assets/messages')  ?>
		<!-- /.login-logo -->
		<div class="card card-outline card-primary w-100 h-100">
			<div class="card-header text-center">
				<a href="" class="h2"><b>Premice</b>Livraiason</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Connectez-vous pour démarrer votre session</p>
				<form action="<?= base_url() ?>" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Email/Tel/Nom" name="login" value="<?= set_value('login') ?>">	
					</div>
					<span class="text-danger"><?=  form_error('login') ?></span>
					<div class="input-group mb-3">
						<input type="password" id="password"  class="form-control" placeholder="Password" name="password">
						<div class="input-group-append">
                            <div class="input-group-text">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                            </div>
                        </div>
					</div>
					<span class="text-danger"><?=  form_error('password') ?></span>
					<!-- /.col -->
					<div class="input-group">
						<button type="submit" name="connexion" class="btn btn-primary btn-block">Connectez-vous</button>
					</div>
					<!-- /.col -->
				</form>

			</div>
			<!-- /.card-body -->
			<p class="text-center">Pas encore de compte <a href="<?= base_url('index.php/inscription') ?>" class="text-center">Inscrivez vous ici</a></p> 
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->
</div>

<script>
    // afficher et cacher le mot de passe
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        // toggle the icon
        this.classList.toggle("bi-eye");
    });
</script>