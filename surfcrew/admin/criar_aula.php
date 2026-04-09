<?php

require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$mensagem = "";

// Buscar instrutores
$stmtInstrutores = $pdo->query("SELECT IdUtilizador, Nome FROM Utilizadores WHERE Tipo = 'Instrutor' AND apagado_em IS NULL");
$instrutores = $stmtInstrutores->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idInstrutor = $_POST["idInstrutor"];
    $dataAula    = $_POST["dataAula"];
    $horaAula    = $_POST["horaAula"];
    $duracao     = $_POST["duracao"];
    $localizacao = $_POST["localizacao"];
    $nivel       = $_POST["nivel"];
    $vaga        = $_POST["vaga"];
    $estado      = $_POST["estado"];

    try {
        $stmtInsert = $pdo->prepare("
            INSERT INTO Aulas (IdInstrutor, DataAula, HoraAula, Duracao, Localizacao, Nivel, Vaga, Estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if ($stmtInsert->execute([$idInstrutor, $dataAula, $horaAula, $duracao, $localizacao, $nivel, $vaga, $estado])) {
            $mensagem = "Aula criada com sucesso!";
        }

    } catch(PDOException $e) {
        $mensagem = "Erro ao criar: " . $e->getMessage();
    }
}

?>

<main class="min-vh-100">
  <!-- logo -->
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class="mb-2 align-items-center">
      <img src="<?php echo $base_url ?>assets/img/logo.png" height="28">
    </a>
  </div>

  <div class="container my-5 col-12 col-md-4 inscrever" id="inscrever">
    <h1 class="fw-bold mb-2 text-white text-center">Criar Aula</h1>
    <?php echo $mensagem; ?>

    <form method="POST">

      <div class="row mb-4 d-flex justify-content-center" style="gap: 40px;">

        <!-- INSTRUTOR -->
        <div class="col-12 col-md-4">
          <label class="form-label">Instrutor</label>
          <select name="idInstrutor" class="form-control">
            <option value="">--Escolha um Instrutor--</option>
            <?php foreach ($instrutores as $i): ?>
            <option value="<?= $i["IdUtilizador"] ?>"><?= $i["Nome"] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- DATA -->
        <div class="col-12 col-md-4">
          <label class="form-label">Data da Aula</label>
          <input type="date" name="dataAula" class="form-control">
        </div>

        <!-- HORA -->
        <div class="col-12 col-md-4">
          <label class="form-label">Hora da Aula</label>
          <input type="time" name="horaAula" class="form-control">
        </div>

        <!-- DURAÇÃO -->
        <div class="col-12 col-md-4">
          <label class="form-label">Duração (minutos)</label>
          <input type="number" name="duracao" class="form-control">
        </div>

        <!-- LOCALIZAÇÃO -->
        <div class="col-12 col-md-4">
          <label class="form-label">Localização</label>
          <select name="localizacao" class="form-control">
            <option value="Praia de Mira">Praia de Mira</option>
            <option value="Praia Poco da Cruz">Praia Poço da Cruz</option>
          </select>
        </div>

        <!-- NÍVEL -->
        <div class="col-12 col-md-4">
          <label class="form-label">Nível</label>
          <select name="nivel" class="form-control">
            <option>Kids</option>
            <option>Normal</option>
            <option>Intermedio</option>
          </select>
        </div>

        <!-- VAGAS -->
        <div class="col-12 col-md-4">
          <label class="form-label">Vagas</label>
          <input type="number" name="vaga" class="form-control">
        </div>

        <!-- ESTADO -->
        <div class="col-12 col-md-4">
          <label class="form-label">Estado</label>
          <select name="estado" class="form-control">
            <option>Aberta</option>
            <option>Fechada</option>
            <option>Cancelada</option>
          </select>
        </div>

        <!-- BOTÃO -->
        <div class="col-12 col-md-4 text-end">
          <button type="submit" class="btn btn-submit">Criar Aula</button>
        </div>

      </div>
            <div class="mt-4">
            <a href="../user/index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
  </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>