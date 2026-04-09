<?php
require_once('../src/includes/db.php');
$mensagem = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $palavraChave = $_POST['palavraChave'];
    $repetir_palavraChave = $_POST['repetir_palavraChave'];
    
    //testar se esta a entrar no if e a mostrar valores
    // echo $nome;
    // echo $palavraChave;
    // echo $repetir_palavraChave;
    if($palavraChave != $repetir_palavraChave){
        $mensagem = "As palavras-chave não coincidem!";
    }
    else {
        $palavraChaveHash = password_hash($palavraChave, PASSWORD_DEFAULT);
        
        try{
            //1. Criar a query de INSERT
            $stmt = "INSERT INTO users (nome, palavraChave) VALUES (?,?)";
            //2. Preparae a query contra injeçoes
            $stmt = $pdo->prepare($stmt);
            // 3. Executar a query com os dados
            if($stmt->execute([$nome,$palavraChaveHash]))                                                   {
            $mensagem = "Registo criado com sucesso";
            }
        }
        catch (PDOException $e){
            $mensagem = "Error ao registrar:" . $e->getMessage();
        }
    }
}


?>


<!DOCTYPE html>
<html>
<head>
<title>Registo Simples</title>
</head>
<body>
<h2>Criar Conta</h2>
<?php echo $mensagem; ?>
<form method="POST" action="">
<label>Nome:</label><br>
<input type="text" name="nome" value="" required><br><br>
<label>Palavra-Chave:</label><br>
<input type="password" name="palavraChave" required><br><br>
<label>Repetir Palavra-Chave:</label><br>
<input type="password" name="repetir_palavraChave" required><br><br>
<button type="submit">Registar</button>
</form>
<br>
<a href="login.php">Já tenho conta</a>
</body>
</html>