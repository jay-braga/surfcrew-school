<?php

require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$id = $_GET['id'];
$mensagem = "";

// 1. Buscar dados atuais
$stmt = $pdo->prepare("SELECT * FROM Aulas WHERE IdAula = ?");
$stmt->execute([$id]);
$aula = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Atualizar dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$dataAula    = $_POST["DataAula"]    ?? "";
$horaAula    = $_POST["HoraAula"]    ?? "";
$duracao     = $_POST["Duracao"]     ?? 0;
$localizacao = $_POST["Localizacao"] ?? "";
$nivel       = $_POST["Nivel"]       ?? "";
$vaga        = $_POST["Vaga"]        ?? 0;
$estado      = $_POST["Estado"]      ?? "";

    try {
        $stmtUpdate = $pdo->prepare("
            UPDATE Aulas 
            SET DataAula = ?, HoraAula = ?, Duracao = ?, Localizacao = ?, Nivel = ?, Vaga = ?, Estado = ?
            WHERE IdAula = ?
        ");

        if ($stmtUpdate->execute([$dataAula, $horaAula, $duracao, $localizacao, $nivel, $vaga, $estado, $id])) {
            $mensagem = "Aula atualizada com sucesso!";
            
            $aula['DataAula'] = $dataAula;
            $aula['HoraAula'] = $horaAula;
            $aula['Duracao'] = $duracao;
            $aula['Localizacao'] = $localizacao;
            $aula['Nivel'] = $nivel;
            $aula['Vaga'] = $vaga;
            $aula['Estado'] = $estado;
        }

    } catch(PDOException $e) {
        $mensagem = "Erro ao atualizar: " . $e->getMessage();
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
    <h1 class="fw-bold mb-2 text-white text-center">Editar Aula</h1>
    <?php echo $mensagem; ?>

    <form method="POST">

      <div class="row mb-4 d-flex justify-content-center" style="gap: 40px;">

        <!-- DATA -->
        <div class="col-12 col-md-4">
          <label class="form-label">Data da Aula</label>
          <input type="date" name="DataAula" class="form-control"
                 value="<?= $aula['DataAula'] ?>">
        </div>

        <!-- HORA -->
        <div class="col-12 col-md-4">
          <label class="form-label">Hora da Aula</label>
          <input type="time" name="HoraAula" class="form-control"
                 value="<?= $aula['HoraAula'] ?>">
        </div>

        <!-- DURAÇÃO -->
        <div class="col-12 col-md-4">
          <label class="form-label">Duração (minutos)</label>
          <input type="number" name="Duracao" class="form-control"
                 value="<?= $aula['Duracao'] ?>">
        </div>

        <!-- LOCALIZAÇÃO -->
        <div class="col-12 col-md-4">
          <label class="form-label">Localização</label>
          <select name="Localizacao" class="form-control">
            <option value="Praia de Mira" 
              <?= $aula['Localizacao']=="Praia de Mira" ? "selected" : "" ?>>
              Praia de Mira
            </option>

            <option value="Praia Poco da Cruz" 
              <?= $aula['Localizacao']=="Praia Poco da Cruz" ? "selected" : "" ?>>
              Praia Poço da Cruz
            </option>
          </select>
        </div>

        <!-- NÍVEL -->
        <div class="col-12 col-md-4">
          <label class="form-label">Nível</label>
          <select name="Nivel" class="form-control">
            <option <?= $aula['Nivel']=="Kids" ? "selected" : "" ?>>Kids</option>
            <option <?= $aula['Nivel']=="Normal" ? "selected" : "" ?>>Normal</option>
            <option <?= $aula['Nivel']=="Intermedio" ? "selected" : "" ?>>Intermedio</option>
          </select>
        </div>

        <!-- VAGAS -->
        <div class="col-12 col-md-4">
          <label class="form-label">Vagas</label>
          <input type="number" name="Vaga" class="form-control"
                 value="<?= $aula['Vaga'] ?>">
        </div>

        <!-- ESTADO -->
        <div class="col-12 col-md-4">
          <label class="form-label">Estado</label>
          <select name="Estado" class="form-control">
            <option <?= $aula['Estado']=="Aberta" ? "selected" : "" ?>>Aberta</option>
            <option <?= $aula['Estado']=="Fechada" ? "selected" : "" ?>>Fechada</option>
            <option <?= $aula['Estado']=="Cancelada" ? "selected" : "" ?>>Cancelada</option>
          </select>
        </div>

        <!-- BOTÃO -->
        <div class="col-12 col-md-4 text-end">
          <button type="submit" class="btn btn-submit">Guardar Alterações</button>
        </div>

      </div>
            <div class="mt-4">
            <a href="../user/index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
  </div>
</main>


<?php require_once('../src/includes/footer.php'); ?>
