<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT 
        Aulas.IdAula, Aulas.DataAula, Aulas.HoraAula, Aulas.Duracao,
        Aulas.Localizacao, Aulas.Nivel, Aulas.Estado,
        Utilizadores.Nome AS NomeInstrutor,
        InscricoesAulas.Estado AS EstadoInscricao
    FROM InscricoesAulas
    JOIN Aulas ON InscricoesAulas.IdAula = Aulas.IdAula
    JOIN Utilizadores ON Aulas.IdInstrutor = Utilizadores.IdUtilizador
    WHERE InscricoesAulas.IdUtilizador = ?
    ORDER BY Aulas.DataAula ASC
");
$stmt->execute([$id]);
$aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="min-vh-100">
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class="mb-2 align-items-center">
      <img src="<?php echo $base_url ?>assets/img/logo.png" height="28">
    </a>
  </div>

<div class="container my-5 inscrever">
    <h1 class="fw-bold mb-4 text-center titulo-pagina">As Minhas Aulas</h1>

    <?php if(empty($aulas)): ?>
      <p class="text-center text-muted">Ainda não tens aulas marcadas.</p>
    <?php else: ?>

    <div class="row g-4">
      <?php foreach ($aulas as $aula): ?>
      <div class="col-12 col-md-4">
        <div class="card h-100 shadow-sm card-aula card-aula-azul">
          <div class="card-aula-header">
            <?= $aula['Nivel'] ?> — <?= $aula['DataAula'] ?>
          </div>
          <div class="card-aula-body">
            <p class="mb-2"><strong>Hora:</strong> <?= $aula['HoraAula'] ?></p>
            <p class="mb-2"><strong>Duração:</strong> <?= $aula['Duracao'] ?> min</p>
            <p class="mb-2"><strong>Local:</strong> <?= $aula['Localizacao'] ?></p>
            <p class="mb-2"><strong>Instrutor:</strong> <?= $aula['NomeInstrutor'] ?></p>
            <p class="mb-2"><strong>Estado da Aula:</strong>
              <span class="badge <?= $aula['Estado'] == 'Aberta' ? 'badge-verde' : ($aula['Estado'] == 'Cancelada' ? 'badge-vermelho' : 'badge-amarelo') ?>">
                <?= $aula['Estado'] ?>
              </span>
            </p>
            <p class="mb-2"><strong>A minha inscrição:</strong>
              <span class="badge <?= $aula['EstadoInscricao'] == 'Presente' ? 'badge-verde' : ($aula['EstadoInscricao'] == 'Faltou' ? 'badge-vermelho' : 'badge-azul') ?>">
                <?= $aula['EstadoInscricao'] ?>
              </span>
            </p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php endif; ?>

    <div class="mt-4">
      <a href="../user/nav_perfil.php" class="btn btn-secondary">Voltar ao Perfil</a>
    </div>
  </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>