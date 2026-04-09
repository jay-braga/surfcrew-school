<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$id = $_SESSION['user_id'];
$mensagem = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // DESINSCREVER
    if(isset($_POST["desinscreverAula"])){
        $idAula = $_POST["desinscreverAula"];
        try{
            $stmtDel = $pdo->prepare("DELETE FROM InscricoesAulas WHERE IdUtilizador = ? AND IdAula = ?");
            if($stmtDel->execute([$id, $idAula])){
                $mensagem = "<div class='alert alert-success'>Desinscrito com sucesso!</div>";
            }
        } catch(PDOException $e){
            $mensagem = "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
        }

    // INSCREVER
    } else {
        $idAula = $_POST["idAula"] ?? "";
        try{
            $stmtCheck = $pdo->prepare("SELECT IdInscricaoAula FROM InscricoesAulas WHERE IdUtilizador = ? AND IdAula = ?");
            $stmtCheck->execute([$id, $idAula]);
            if($stmtCheck->fetch()){
                $mensagem = "<div class='alert alert-warning'>Já estás inscrito nesta aula!</div>";
            } else {
                $stmtInscrever = $pdo->prepare("INSERT INTO InscricoesAulas (IdUtilizador, IdAula) VALUES (?, ?)");
                if($stmtInscrever->execute([$id, $idAula])){
                    $mensagem = "<div class='alert alert-success'>Inscrição realizada com sucesso!</div>";
                }
            }
        } catch(PDOException $e){
            $mensagem = "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
        }
    }
}

$stmt = $pdo->query("
    SELECT 
        Aulas.IdAula, Aulas.DataAula, Aulas.HoraAula, Aulas.Duracao,
        Aulas.Localizacao, Aulas.Nivel, Aulas.Vaga, Aulas.Estado,
        Utilizadores.Nome AS NomeInstrutor,
        (Aulas.Vaga - COUNT(InscricoesAulas.IdInscricaoAula)) AS VagasDisponiveis
    FROM Aulas
    LEFT JOIN InscricoesAulas ON Aulas.IdAula = InscricoesAulas.IdAula
    JOIN Utilizadores ON Aulas.IdInstrutor = Utilizadores.IdUtilizador
    WHERE Aulas.DataAula >= CURDATE()
    GROUP BY Aulas.IdAula
    ORDER BY Aulas.DataAula ASC
");
$aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmtInscritas = $pdo->prepare("SELECT IdAula FROM InscricoesAulas WHERE IdUtilizador = ?");
$stmtInscritas->execute([$id]);
$aulasInscritas = $stmtInscritas->fetchAll(PDO::FETCH_COLUMN);
?>

<main class="min-vh-100">
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class="mb-2 align-items-center">
      <img src="<?php echo $base_url ?>assets/img/logo.png" height="28">
    </a>
  </div>

  <div class="container my-5 inscrever">
    <h1 class="fw-bold mb-4 text-center titulo-pagina">Mapa de Aulas</h1>

    <?= $mensagem ?>

    <?php if(empty($aulas)): ?>
      <p class="text-center text-muted">Não há aulas disponíveis de momento.</p>
    <?php else: ?>

    <div class="row g-4">
      <?php foreach ($aulas as $aula): ?>
      <div class="col-12 col-md-4">

        <?php
          if($aula['Estado'] == 'Aberta' && $aula['VagasDisponiveis'] > 0){
            $classeCard   = "card-aula-azul";
            $classeHeader = "card-aula-header";
            $estadoTexto  = "Aberta";
          } elseif($aula['VagasDisponiveis'] <= 0){
            $classeCard   = "card-aula-vermelho";
            $classeHeader = "card-aula-header-vermelho";
            $estadoTexto  = "Sem Vagas";
          } else {
            $classeCard   = "card-aula-amarelo";
            $classeHeader = "card-aula-header-amarelo";
            $estadoTexto  = $aula['Estado'];
          }
        ?>

        <div class="card h-100 shadow-sm card-aula <?= $classeCard ?>">
          <div class="<?= $classeHeader ?>">
            <?= $aula['Nivel'] ?> — <?= $estadoTexto ?>
          </div>
          <div class="card-aula-body">
            <p class="mb-2"><strong>Data:</strong> <?= $aula['DataAula'] ?></p>
            <p class="mb-2"><strong>Hora:</strong> <?= $aula['HoraAula'] ?></p>
            <p class="mb-2"><strong>Duração:</strong> <?= $aula['Duracao'] ?> min</p>
            <p class="mb-2"><strong>Local:</strong> <?= $aula['Localizacao'] ?></p>
            <p class="mb-2"><strong>Instrutor:</strong> <?= $aula['NomeInstrutor'] ?></p>
            <p class="mb-2"><strong>Vagas disponíveis:</strong>
<span class="fw-bold <?= 
  $aula['Estado'] == 'Cancelada' ? 'vagas-cancelada' : 
  ($aula['VagasDisponiveis'] > 0 ? 'vagas-disponiveis' : 'vagas-esgotadas') 
?>">
  <?= $aula['Estado'] == 'Cancelada' ? 'Cancelada' : $aula['VagasDisponiveis'] . ' / ' . $aula['Vaga'] ?>
</span>
            </p>
          </div>
          <div class="card-footer text-center card-aula-footer">
            <?php if(in_array($aula['IdAula'], $aulasInscritas)): ?>
              <form method="POST" class="mt-1">
                <input type="hidden" name="desinscreverAula" value="<?= $aula['IdAula'] ?>">
                <button type="submit" class="btn btn-danger">Desinscrever</button>
              </form>
            <?php elseif($aula['Estado'] == 'Aberta' && $aula['VagasDisponiveis'] > 0): ?>
              <form method="POST">
                <input type="hidden" name="idAula" value="<?= $aula['IdAula'] ?>">
                <button type="submit" class="btn-adm">Inscrever</button>
              </form>
            <?php elseif($aula['Estado'] == 'Fechada'): ?>
              <span class="btn btn-warning disabled">Em breve</span>
            <?php else: ?>
              <span class="btn btn-danger disabled">Sem Vagas</span>
            <?php endif; ?>
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