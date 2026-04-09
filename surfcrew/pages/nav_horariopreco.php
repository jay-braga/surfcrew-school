<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');
?>

<main>
    <!-- logo -->
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class=" mb-2 align-items-center"><img src="<?php echo $base_url ?>assets/img/logo.png" height="38"></a>
  </div>

<div class="container-fluid p-0">
<div class="horario align-items-center justify-content-center text-center" role="img" aria-label="Rapaz surfando">
 
<div class="d-flex flex-column align-items-center">
 
  <h1 class="fw-bold mb-2" id="title">Horários</h1>
 
  <div class="row w-100">
 
    <!-- Bloco Verão ocupa metade -->
<div class="col-12 col-md-3 p-2">
<p class="fw-bold text-start estacao">Verão</p>
<p class="textt fw-bold">Manhã</p>
<p class="texth">(SEG-SAB): 9.30/11.00</p>
 
      <p class="textt fw-bold">Tarde</p>
<p class="texth">(SEG-DOM): 15.00/16.30/18.30</p>
</div>
 
    <!-- Bloco Inverno deslocado para a direita -->
<div class="col-12 col-md-3 offset-md-6 p-2">
<p class="fw-bold text-start estacao">Inverno</p>
<p class="textt fw-bold">Manhã</p>
<p class="texth">(SEG-SAB): 11:00</p>
 
      <p class="textt fw-bold">Tarde</p>
<p class="texth">(SEG-DOM): 15:00</p>
</div>
 
  </div>
 
</div>
</div>
</div>
</div>

    <!--Section aula-->
    <section id="aula" class="container my-5">
        <div class="col-12">
  <div class="preco align-items-center justify-content-center text-center" role="img" aria-label="Aula de surf">
    <div class="d-flex flex-column align-items-center">
      <p class="fw-bold mb-2" id="titlep">Preço</p>
      </div>
    </div>
  </div>
  
</section>

      <section id="sobre" class="container my-5">
      <div class="row align-items-center g-4">
        <!-- TEXTO -->
      <div class="col-12 col-lg-6">
          <h2 class="h4 fw-bold mb-3 textp">1 Pessoa</br> Preço: 30€</h2>
          <p class="textp"><strong>Para residentes: 25€</strong> <br>
          (No momento de compra aplicar o código "local")
          Aula inserida nas aulas de grupo e em horários já definidos. </p>
        </div>

        <!-- MAPA DE AULAS -->
        <div class="col-12 col-lg-6">
          <div class="card border-0 card-perfil p-4">
            <h3 class="fw-bold text-white text-center mb-4">Mapa de Aulas</h3>

            <?php
            $stmtAulas = $pdo->query("
                SELECT 
                    Aulas.DataAula, Aulas.HoraAula, Aulas.Nivel, Aulas.Localizacao,
                    (Aulas.Vaga - COUNT(InscricoesAulas.IdInscricaoAula)) AS VagasDisponiveis
                FROM Aulas
                LEFT JOIN InscricoesAulas ON Aulas.IdAula = InscricoesAulas.IdAula
                WHERE Aulas.DataAula >= CURDATE() AND Aulas.Estado = 'Aberta'
                GROUP BY Aulas.IdAula
                ORDER BY Aulas.DataAula ASC
                LIMIT 4
            ");
            $aulasDisponiveis = $stmtAulas->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php if(empty($aulasDisponiveis)): ?>
              <p class="text-white text-center">Não há aulas disponíveis de momento.</p>
            <?php else: ?>
              <?php foreach($aulasDisponiveis as $aula): ?>
              <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded" style="background-color: rgba(255,255,255,0.15);">
                <div>
                  <p class="text-white fw-bold mb-0"><?= $aula['Nivel'] ?></p>
                  <p class="text-white mb-0" style="font-size: 14px;"><?= $aula['DataAula'] ?> — <?= $aula['HoraAula'] ?></p>
                  <p class="text-white mb-0" style="font-size: 13px; opacity: 0.8;"><?= $aula['Localizacao'] ?></p>
                </div>
                <span class="badge" style="background-color: <?= $aula['VagasDisponiveis'] > 0 ? '#27AE60' : '#dc3545' ?>">
                  <?= $aula['VagasDisponiveis'] ?> vagas
                </span>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>

            <div class="text-center mt-3">
              <?php if(isset($_SESSION['user_id'])): ?>
                <a href="../pages/mapa_aulas.php" class="btn-adm">Ver todas as aulas</a>
              <?php else: ?>
                <a href="../auth/nav_acessar.php" class="btn-adm">Inscrever-se</a>
              <?php endif; ?>
            </div>

          </div>
        </div>

      </div>
    </section>
</main>

<?php require_once('../src/includes/footer.php'); ?>
