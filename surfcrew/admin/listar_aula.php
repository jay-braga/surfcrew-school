<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$stmt = $pdo->query("SELECT IdAula, DataAula, HoraAula, Estado FROM Aulas ORDER BY CriadoEm DESC");
$aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mensagem = "";
if(isset($_GET['status'])){
    $status = $_GET['status'];
    $mensagem = 'Um registo foi ' . $status;
}
?>

<main class="min-vh-100">
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class="mb-2 align-items-center">
      <img src="<?php echo $base_url ?>assets/img/logo.png" height="28">
    </a>
  </div>

  <div class="container my-5">
    <h1 class="fw-bold mb-4 text-center titulo-pagina">Aulas Registadas</h1>
    <p><?= $mensagem ?></p>
    <div class="mb-3">
      <a href="criar_aula.php" class="btn btn-adm">Adicionar nova aula</a>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover text-center tabela-admin">
        <thead>
          <tr>
            <th>#</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($aulas as $aula): ?>
          <tr>
            <td><?= $aula['IdAula'] ?></td>
            <td><?= $aula['DataAula'] ?></td>
            <td><?= $aula['HoraAula'] ?></td>
            <td><?= $aula['Estado'] ?></td>
            <td>
              <a href="editar_aula.php?id=<?= $aula['IdAula'] ?>" class="btn btn-primary btn-sm">Editar</a>
              <a href="apagar_aula.php?id=<?= $aula['IdAula'] ?>" class="btn btn-danger btn-sm">Apagar</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
         <div class="mt-4">
            <a href="../user/index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
  </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>