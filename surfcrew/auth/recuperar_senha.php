<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');
?>
<main class="min-vh-100">
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class="mb-2 align-items-center">
      <img src="<?php echo $base_url ?>assets/img/logo.png" height="28">
    </a>
  </div>

  <div class="container my-5 col-12 col-md-4 inscrever">
    <h1 class="fw-bold mb-4 text-white text-center">Recuperar Senha</h1>

    <form method="POST">
  <div class="row mb-4 d-flex justify-content-center" style="gap: 40px;">

    <div class="col-12 col-md-6 text-center">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control"
             placeholder="exemplo@gmail.com" required>
      <div class="mt-3">
        <button type="submit" class="btn btn-submit">Enviar</button>
      </div>
      <div class="mt-3">
        <a href="../auth/login.php" class="recuperar-password">Voltar ao Login</a>
      </div>
    </div>

  </div>
</form>

      </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>