<?php 

require_once '../src/includes/db.php';

$erro = "";
//verificamos se existe um post para não ter erros de variaveis
if($_SERVER["REQUEST_METHOD"] == "POST" ){

    $email =  $_POST["Email"];
    $senha =  $_POST["Senha"];
    
    //procurar o utilizador na db
    // 1.criamos o statement #stmt (a instrução preparada)
    $stmt = $pdo->prepare("SELECT IdUtilizador, Senha, Nome, Email, Tipo FROM Utilizadores WHERE Email = ?");
    //2.executar o statement com os dados (substituir o ?)
    $stmt->execute([$email]);
    //3. vamos buscar e guardar o resultados
    $user = $stmt->fetch();
    

    if($user && password_verify($senha, $user['Senha'])){
        
        $_SESSION['user_id'] = $user['IdUtilizador'];
        $_SESSION['user_name'] = $user['Nome'];
        $_SESSION['user_tipo'] = $user['Tipo'];
        //vamos adicionar aqui o tipo de utilizador (admin, user,...)
        if($user['Tipo'] == "Admin"){
            header("Location: ../user/index.php"); //redireciono o utilizador para a area dele
        exit;
            
        }else{
            header("Location: ../user/nav_perfil.php"); //redireciono o utilizador para a area dele
        exit;}
        
    } else {
        $erro = "Utilizador ou palavra-chave inválidos!";
    }
    
    //echo $user['id'];
    //user: admin
    //password: 123456
    
    
}


require_once('../src/includes/head.php');
require_once('../src/includes/nav_bar.php');

?>


<main class="min-vh-100">
  <!-- logo -->
  <div class="container my-5 col-12 col-md-4  d-flex justify-content-center align-items-center">
  <a class=" mb-2 align-items-center"><img src="<?php echo $base_url ?>assets/img/logo.png" height="28"></a></div>

    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 login">

          <h1 class="fw-bold mb-2 text-white text-center">Login</h1>
            <?php  if($erro)  echo "<p style='color:red;'>$erro</p>";  ?>
          <form method="POST" >
            <div class="row mb-4 d-flex justify-content-center">

              <div class="col-12 col-md-4 mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="Email" class="form-control" id="exampleEmail" placeholder="exemplo@gmail.com">
              </div>

              <div class="col-12 col-md-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="Senha" class="form-control" id="examplePassword">

                <div class="mt-3 text-end">
                  <button type="submit" class="btn btn-submit">Confirmar</button>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                  <a href="nav_inscrever.php" class="recuperar-password">Criar conta</a>
                  <a href="recuperar_senha.php" class="recuperar-password">Recuperar Password</a>
                </div>

              </div>

            </div>
          </form>

        </div>
      </div>
    </div>

</main>
<?php require_once('../src/includes/footer.php'); ?>