<?php

require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$id = $_SESSION['user_id'];
// Buscar dados do utilizador
$stmt = $pdo->prepare("SELECT IdUtilizador, Nome, Email, Telemovel FROM Utilizadores WHERE IdUtilizador = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Variáveis
$nome  = $user['Nome'];
$email = $user['Email'];
$phone = $user['Telemovel'];

$_SESSION['user_email'] = $email;
$_SESSION['user_phone'] = $phone;

?>

<main class="py-4">
  <div class="container">

    <!-- TÍTULO -->
    <div class="text-center mb-4">
      <h1 class="titulo-perfil d-flex align-items-center justify-content-center gap-2">Perfil</h1>
    </div>

    <!-- CARD PERFIL -->
    <div class="card border-0 text-white mb-4 card-perfil">
      <div class="card-body p-4 p-lg-5">
        <div class="row align-items-center g-4">

          <!-- IMAGEM -->
          <div class="col-12 col-md-4 text-center">
            <img src="<?php echo $base_url ?>assets/img/login.png"
                class="img-fluid rounded-3 shadow imagem-perfil"
                alt="Sombra na areia de um rapaz com uma prancha">
          </div>

          <div class="col-12 col-md-8">
            <!-- NOME + BOTÕES -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-3">
              <h2 class="fw-bold mb-0">Olá, <?php echo $_SESSION['user_name'] ?></h2>
              <div class="d-flex gap-2">
                <a href="../admin/editar_perfil_users.php?id=<?= $user['IdUtilizador'] ?>" class="btn btn-outline-light btn-sm px-4">Editar</a>
                <a href="../auth/logout.php" class="btn btn-danger btn-sm px-4">Logout</a>
              </div>
            </div>

            <!-- DADOS -->
            <div class="mt-3">
              <p class="mb-3 d-flex align-items-center gap-2">
                <img src="<?php echo $base_url ?>assets/img/email.png" class="icone-perfil" alt="Email">
                <?php echo $_SESSION['user_email'] ?>
              </p>
              <p class="mb-3 d-flex align-items-center gap-2">
                <img src="<?php echo $base_url ?>assets/img/phone.png" class="icone-perfil" alt="Telefone">
                <?php echo $_SESSION['user_phone'] ?>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- DASHBOARD -->
  <div class="card border-0 card-dashboard">
    <div class="card-body p-4 p-lg-5">
      <h2 class="text-center fw-bold mb-5 admin-section-title">DashBoard</h2>

      <div class="row g-4 justify-content-center">

        <div class="col-12 col-md-4 text-center">
          <a href="../pages/mapa_aulas.php" class="btn btn-admin w-100 py-3">
            Ver Mapa de Aulas
          </a>
        </div>

        <div class="col-12 col-md-4 text-center">
          <a href="../pages/minhas_aulas.php" class="btn btn-admin w-100 py-3">
            As Minhas Aulas
          </a>
        </div>

      </div>
    </div>
  </div>

</main>

<?php require_once('../src/includes/footer.php'); ?>