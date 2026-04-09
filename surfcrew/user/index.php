<?php

     require_once('../src/includes/db.php');
     require_once('../src/includes/head.php');
     require_once('../src/includes/nav_bar.php');

?>

<main class="py-4">
  <div class="container">
    <div class="text-center mb-4">
      <h1 class="titulo-perfil">Painel do Administrador</h1>
    </div>

    <!-- CARD PRINCIPAL -->
    <div class="card border-0 text-white mb-4 card-perfil">
      <div class="card-body p-4 p-lg-5">
        <div class="row align-items-center g-4">

          <!-- IMAGEM -->
          <div class="col-12 col-md-4 text-center">
            <img src="<?php echo $base_url ?>assets/img/login.png"
                class="img-fluid rounded-3 shadow imagem-perfil"
                alt="Administrador">
          </div>

          <!-- TEXTO -->
          <div class="col-12 col-md-8">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-3">
              <h2 class="fw-bold mb-0">Olá, <?php echo $_SESSION['user_name']?></h2>
              <a href="../auth/logout.php" class="btn btn-danger btn-sm px-4">Logout</a>
            </div>

            <p class="text-white-50">Bem‑vindo ao painel de controlo. Aqui pode gerir aulas e utilizadores.</p>
          </div>

        </div>
      </div>
    </div>

    <!-- DASHBOARD -->
    <div class="card border-0 card-dashboard">
      <div class="card-body p-4 p-lg-5">
        <h2 class="text-center fw-bold mb-5 admin-section-title">Gestão do Sistema</h2>

        <div class="row g-4">

          <!-- AULAS -->
          <div class="col-lg-6">
            <div class="admin-box">
              <h3 class="admin-box-title">Aulas</h3>

              <div class="d-grid gap-3">
                <a href="../admin/listar_aula.php" class="btn btn-adm">Ver Lista de Aulas</a>
                <a href="../admin/criar_aula.php" class="btn btn-admin">Criar Nova Aula</a>
                <a href="../admin/user_grupo2.php" class="btn btn-adm">Adicionar Utilizadores</a>
              </div>
            </div>
          </div>

          <!-- UTILIZADORES -->
          <div class="col-lg-6">
            <div class="admin-box">
              <h3 class="admin-box-title">Utilizadores</h3>

              <div class="d-grid gap-3">
                <a href="../admin/listar_users.php" class="btn btn-adm">Ver Lista de Utilizadores</a>
                <a href="../admin/criar_utilizador.php" class="btn btn-admin">Criar Novo Utilizador</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</main>




<?php 
 require_once('../src/includes/footer.php'); 
?>