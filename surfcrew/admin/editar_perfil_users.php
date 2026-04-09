<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$id = $_SESSION['user_id'];
$mensagem = "";

// 1. Ir buscar os dados atuais
$stmt = $pdo->prepare("SELECT * FROM Utilizadores WHERE IdUtilizador = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Atualizar dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome           = $_POST["Nome"];
    $apelido        = $_POST["Apelido"];
    $dataNascimento = $_POST["data_nascimento"];
    $documento      = $_POST["documento"] ?? null;
    $email          = $_POST["email"];
    $telemovel      = $_POST["phone"];

    try{
        if(!empty($_POST['Senha'])){
            $senhaHash  = password_hash($_POST['Senha'], PASSWORD_DEFAULT);
            $stmtUpdate = $pdo->prepare("UPDATE Utilizadores SET Nome = ?, Apelido = ?, DataNascimento = ?, DocumentoIdentificacao = ?, Email = ?, Telemovel = ?, Senha = ? WHERE IdUtilizador = ?");
            if ($stmtUpdate->execute([$nome, $apelido, $dataNascimento, $documento, $email, $telemovel, $senhaHash, $id])){
                $mensagem = "Atualizado com sucesso!";
                $user['Nome']                  = $nome;
                $user['Apelido']               = $apelido;
                $user['DataNascimento']         = $dataNascimento;
                $user['DocumentoIdentificacao'] = $documento;
                $user['Email']                 = $email;
                $user['Telemovel']             = $telemovel;
                $_SESSION['user_name']         = $nome;
            } 
        } else {       
            $stmtUpdate = $pdo->prepare("UPDATE Utilizadores SET Nome = ?, Apelido = ?, DataNascimento = ?, DocumentoIdentificacao = ?, Email = ?, Telemovel = ? WHERE IdUtilizador = ?");
            if ($stmtUpdate->execute([$nome, $apelido, $dataNascimento, $documento, $email, $telemovel, $id])){
                $mensagem = "Atualizado com sucesso!";
                $user['Nome']                  = $nome;
                $user['Apelido']               = $apelido;
                $user['DataNascimento']         = $dataNascimento;
                $user['DocumentoIdentificacao'] = $documento;
                $user['Email']                 = $email;
                $user['Telemovel']             = $telemovel;
                $_SESSION['user_name']         = $nome;
            }
        }
    }
    catch(PDOException $e){
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
    <h1 class="fw-bold mb-2 text-white text-center">Editar Perfil</h1>
    <?php echo $mensagem; ?>

    <form method="POST">
      <div class="row mb-4 d-flex justify-content-center" style="gap: 40px;">

        <div class="col-12 col-md-4">
          <label class="form-label">Nome</label>
          <input type="text" name="Nome" class="form-control"
                 value="<?= $user['Nome'] ?>" placeholder="João">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Apelido</label>
          <input type="text" name="Apelido" class="form-control"
                 value="<?= $user['Apelido'] ?>" placeholder="Silva">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control"
                 value="<?= $user['DataNascimento'] ?>">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Telemóvel</label>
          <input type="tel" name="phone" class="form-control"
                 value="<?= $user['Telemovel'] ?>" placeholder="912345678" maxlength="9" pattern="[0-9]{9}">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control"
                 value="<?= $user['Email'] ?>" placeholder="exemplo@gmail.com">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Documento de Identificação</label>
          <input type="text" name="documento" class="form-control"
                 value="<?= $user['DocumentoIdentificacao'] ?>">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Nova Palavra‑Chave (deixe vazio para manter a atual)</label>
          <input type="password" name="Senha" class="form-control">
          <div class="mt-3 text-end">
            <button type="submit" class="btn btn-submit">Guardar Alterações</button>
          </div>
        </div>
                <div class="mt-4">
            <a href="../user/nav_perfil.php" class="btn btn-secondary">Voltar</a>
        </div>
      </div>
    </form>
  </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>