<?php 
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

$mensagem = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome                  = $_POST["nome"];
    $apelido               = $_POST["apelido"];
    $dataNascimento        = $_POST["dataNascimento"];
    $email                 = $_POST["email"];
    $senha                 = $_POST["senha"];
    $telemovel             = $_POST["telemovel"];
    $tipo                  = $_POST["tipo"];
    $nivelInstrutor        = $_POST["nivelInstrutor"];

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try{
        $sql = "INSERT INTO Utilizadores 
                (Nome, Apelido, DataNascimento, Email, Senha, Telemovel, Tipo, nivelInstrutor) 
                VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$nome, $apelido, $dataNascimento, $email, $senhaHash, $telemovel, $tipo, $nivelInstrutor])){
            $mensagem = "Utilizador criado com sucesso!";
        }else{
            $mensagem = "Erro ao criar utilizador!";
        }
        
    }catch (PDOException $e){
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>

<main class="min-vh-100">

  <div class="container my-5 col-12 col-md-4 d-flex justify-content-center align-items-center">
    <a class="mb-2 align-items-center">
      <img src="<?php echo $base_url ?>assets/img/logo.png" height="28">
    </a>
  </div>

  <div class="container my-5 col-12 col-md-6 inscrever">
    <h1 class="fw-bold mb-4 text-white text-center">Criar Novo Utilizador</h1>

    <?= $mensagem ?>

    <form method="POST">
      <div class="row d-flex justify-content-center" style="gap: 20px;">

        <div class="col-12 col-md-5">
          <label class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" placeholder="Nome" required>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Apelido</label>
          <input type="text" name="apelido" class="form-control" placeholder="Apelido" required>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="dataNascimento" class="form-control" required>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="email@exemplo.com" required>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Telemóvel</label>
          <input type="number" name="telemovel" class="form-control" placeholder="9XXXXXXXX" required>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" placeholder="Senha" required>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Tipo</label>
          <select name="tipo" class="form-control" required>
            <option value="">-- Escolha o Tipo --</option>
            <option value="Admin">Admin</option>
            <option value="Aluno">Aluno</option>
            <option value="Instrutor">Instrutor</option>
          </select>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Nível Instrutor</label>
          <select name="nivelInstrutor" class="form-control">
            <option value="">-- Apenas para Instrutores --</option>
            <option value="kids">Kids</option>
            <option value="normal">Normal</option>
            <option value="avançado">Avançado</option>
          </select>
        </div>

        <div class="col-12 text-center mt-3">
          <button type="submit" class="btn btn-submit px-5">Criar Utilizador</button>
        </div>

      </div>
              <div class="mt-4">
            <a href="../user/index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
  </div>

</main>

<?php require_once('../src/includes/footer.php'); ?>