<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$stmt = $pdo->query("SELECT IdUtilizador, Nome, Tipo, CriadoEm FROM Utilizadores ORDER BY CriadoEm DESC");
$Utilizadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <h1 class="fw-bold mb-4 text-center titulo-pagina">Utilizadores Registados</h1>
    <p><?= $mensagem ?></p>
    <div class="mb-3">
      <a href="criar_utilizador.php" class="btn btn-adm">Adicionar novo utilizador</a>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover text-center tabela-admin">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Data de Registo</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Utilizadores as $utilizador): ?>
          <tr>
            <td><?php echo $utilizador['IdUtilizador'] ?></td>
            <td><?php echo $utilizador['Nome'] ?></td>
            <td>
              <form method="POST" action="editar_tipo_user.php">
                <input type="hidden" name="id" value="<?= $utilizador['IdUtilizador'] ?>">
                <select name="tipo" class="form-control form-control-sm" onchange="this.form.submit()">
                  <option <?= $utilizador['Tipo'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                  <option <?= $utilizador['Tipo'] == 'Aluno' ? 'selected' : '' ?>>Aluno</option>
                  <option <?= $utilizador['Tipo'] == 'Instrutor' ? 'selected' : '' ?>>Instrutor</option>
                </select>
              </form>
            </td>
            <td><?php echo $utilizador['CriadoEm'] ?></td>
            <td>
              <a href="editar_users.php?id=<?= $utilizador['IdUtilizador'] ?>" class="btn btn-primary btn-sm">Editar</a>
              <a href="apagar_users.php?id=<?= $utilizador['IdUtilizador'] ?>" class="btn btn-danger btn-sm">Apagar</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
        <div class="mt-4">
            <a href="../user/index.php" class="btn btn-secondary">Voltar</a>
        </div>
  </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>