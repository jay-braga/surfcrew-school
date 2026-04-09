<?php 
require_once('../src/includes/db.php');
require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

//Vou buscar os dados da minha primeira tabela
//certifico-me que tenho o id e um dado de identificação facil(nome, username, email...)
//não esquecer mo WHERE para filtrar os registos validos
$stmtUsers = $pdo->query("SELECT IdUtilizador, Nome FROM Utilizadores WHERE apagado_em IS NULL ORDER BY Nome ASC");
$utilizadores = $stmtUsers->fetchALL(PDO::FETCH_ASSOC);

//Vou buscar os dados da segunda tabela
//Faz um join para ir buscar o nome do instrutor
$stmtGrupos = $pdo->query("
    SELECT Aulas.IdAula, Aulas.Nivel, Aulas.DataAula, Aulas.HoraAula, Aulas.Localizacao, Utilizadores.Nome 
    FROM Aulas 
    JOIN Utilizadores ON Aulas.IdInstrutor = Utilizadores.IdUtilizador
    ORDER BY Aulas.Nivel ASC
");
$grupos = $stmtGrupos->fetchAll(PDO::FETCH_ASSOC);


$mensagem = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    $grupo_id = $_POST["grupo_id"];
    try{
        
        $sql = "INSERT INTO InscricoesAulas (IdUtilizador, IdAula) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute([$user_id, $grupo_id])){
            $mensagem = "Utilizador associado ao grupo com sucesso!";
        }else{
            $mensagem = "Erro!";
        }
        
    }catch (PDOException $e){
        $mensagem = "Erro! " . $e->getMessage();
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
    <h1 class="fw-bold mb-2 text-white text-center">Adicionar Utilizadores a Aula</h1>
    <p><?= $mensagem ?></p>

    <form method="POST">

      <div class="row mb-4 d-flex justify-content-center" style="gap: 40px;">

        <!-- UTILIZADOR -->
        <div class="col-12 col-md-4">
          <label class="form-label">Selecionar Utilizador</label>
          <select name="user_id" class="form-control">
            <option value="">--Escolha um Utilizador--</option>
            <?php foreach ($utilizadores as $u): ?>
            <option value="<?= $u["IdUtilizador"] ?>"><?= $u["Nome"] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- GRUPO -->
        <div class="col-12 col-md-4">
          <label class="form-label">Selecionar uma Aula</label>
          <select name="grupo_id" class="form-control">
            <option value="">--Escolha um Nível--</option>
            <?php foreach ($grupos as $g): ?>
            <option value="<?= $g["IdAula"] ?>">
                <?= $g["Nivel"] ?> | <?= $g["DataAula"] ?> | <?= $g["HoraAula"] ?> | <?= $g["Localizacao"] ?> | <?= $g["Nome"] ?>
            </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- BOTÃO -->
        <div class="col-12 col-md-4 text-end">
          <button type="submit" class="btn btn-submit">Efetuar Ligação</button>
        </div>
      </div>
        <div class="mt-4">
            <a href="../user/index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
  </div>
</main>

<?php require_once('../src/includes/footer.php'); ?>
