<?php
require_once('../src/includes/db.php');
$mensagem = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST['Nome'];
    $apelido = $_POST['Apelido'];
    $dataNascimento = $_POST['data_nascimento'];
    $documento = $_POST['documento'] ?? null;
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $telemovel = $_POST['phone'];

    // valores fixos
    $tipo = "Aluno";
    $nivelInstrutor = "";

    // Hash da password
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        //1. Criar a query de INSERT
        $stmt = $pdo->prepare("
            INSERT INTO Utilizadores 
            (Nome, Apelido, DataNascimento, DocumentoIdentificacao, Email, Senha, Telemovel, Tipo, nivelInstrutor, CriadoEm)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
            
        ");
        //2. Preparae a query contra injeçoes
        if($stmt->execute([$nome, $apelido, $dataNascimento, $documento, $email, $senhaHash, $telemovel, $tipo, $nivelInstrutor])){
    
            // guardar dados na sessão
            //session_start();
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_name'] = $nome;
            $_SESSION['user_tipo'] = $tipo;
        $mensagem = "Registo efetuado com sucesso!";
            //redirecionar para o perfil
            header("Location: ../user/perfil.php");
            exit;
        }

        // 3. Executar a query com os dados
    } catch (PDOException $e){
        $mensagem = "Erro ao registrar: " . $e->getMessage();
    }
}
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');
?>


<main class="min-vh-100">
  <!-- logo -->
  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
  <a class=" mb-2 align-items-center"><img src="<?php echo $base_url ?>assets/img/logo.png" height="28"></a></div>

<div class="container my-5 col-12 col-md-4 inscrever" id="inscrever">
  <h1 class="fw-bold mb-2 text-white text-center">Criar Conta</h1>
<?php echo $mensagem; ?>
    <form method="POST">

    <div class="row mb-4 d-flex justify-content-center" style="gap: 40px;">

    <div class="col-12 col-md-4">
      <label for="inputNome" class="form-label">Nome</label>
      <input type="text" name="Nome" class="form-control" id="inputNome" placeholder="João">
    </div>

    <div class="col-12 col-md-4">
      <label for="inputApelido" class="form-label">Apelido</label>
      <input type="text" name="Apelido" class="form-control" id="inputApelido" placeholder="Silva">
    </div>

    <div class="col-12 col-md-4">
      <label for="inputdate" class="form-label">Data nascimento</label>
      <input type="date" name="data_nascimento" class="form-control" id="inputdate">
    </div>

      <div class="col-12 col-md-4">
      <label for="inputTelemovel" class="form-label">Telemovél</label>
      <input type="tel" name="phone" class="form-control" id="inputTelemovel"
      placeholder="912345678" maxlength="9" pattern="[0-9]{9}">
    </div>
<!-- EMAIL -->
    <div class="col-12 col-md-4">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="exemplo@gmail.com">
    </div>

    <!-- PASSWORD + BOTÃO + LINK -->
    <div class="col-12 col-md-4">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1">

      <div class="mt-3 text-end">
        <button type="submit" class="btn btn-submit">Criar Conta</button>
      </div>

    </div>

  </div>

</form>

</div>

</main>

<?php require_once('../src/includes/footer.php'); ?>