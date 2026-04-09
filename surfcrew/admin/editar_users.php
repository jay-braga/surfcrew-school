<?php
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');
$id = $_GET['id'] ;
$mensagem = "";
// 1. Ir buscar os dados atuais
$stmt = $pdo->prepare("SELECT * FROM Utilizadores WHERE IdUtilizador = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// 2. Atualizar dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];
    try{
        if(!empty($_POST['Senha'])){
            $SenhaEncrip = password_hash($_POST['Senha'], PASSWORD_DEFAULT);
            $stmtUpdate = $pdo->prepare("UPDATE Utilizadores SET Nome = ?, Tipo = ?, Senha = ? WHERE IdUtilizador = ?");
            if ($stmtUpdate->execute([$nome, $tipo, $SenhaEncrip, $id])){
            $mensagem = "Atualizado com sucesso!";
            $user['Nome'] = $nome; 
            } 
        }
        else{       
            $stmtUpdate = $pdo->prepare("UPDATE Utilizadores SET Nome = ?, Tipo = ? WHERE IdUtilizador = ?");
            if ($stmtUpdate->execute([$nome, $tipo, $id])){
            $mensagem = "Atualizado com sucesso!";
            $user['Nome'] = $nome; 
            }
        }
    }
    catch(PDOException $e ){
        $mensagem = "Error ao atualizar: " . $e->getMessage();
    }
}
?>

<main class="min-vh-100">
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class="mb-2 align-items-center">
      <img src="<?php echo $base_url ?>assets/img/logo.png" height="28">
    </a>
  </div>

  <div class="container my-5 col-12 col-md-4 inscrever" id="inscrever">
    <h1 class="fw-bold mb-2 text-white text-center">Editar Utilizador</h1>
    <?php echo $mensagem; ?>

    <form method="POST">
      <div class="row mb-4 d-flex justify-content-center" style="gap: 40px;">

    <div class="col-12 col-md-4">
      <label class="form-label">Nome</label>
      <input type="text" name="nome" class="form-control"
             value="<?= htmlspecialchars($user['Nome']) ?>" required>
    </div>

    <div class="col-12 col-md-4">
      <label class="form-label">Tipo</label>
      <select name="tipo" class="form-control">
        <option <?= $user['Tipo'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
        <option <?= $user['Tipo'] == 'Aluno' ? 'selected' : '' ?>>Aluno</option>
        <option <?= $user['Tipo'] == 'Instrutor' ? 'selected' : '' ?>>Instrutor</option>
      </select>
    </div>

    <div class="col-12 col-md-4">
      <label class="form-label">Nova Palavra‑Chave (deixe vazio para manter a atual)</label>
      <input type="password" name="Senha" class="form-control">
      <div class="mt-3 d-flex justify-content-between">
        <a href="listar_users.php" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-submit">Guardar Alterações</button>
      </div>
    </div>

</div>
    </form>
  </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>