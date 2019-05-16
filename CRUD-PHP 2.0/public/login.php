<?php require_once("../conexao/conexao.php"); ?>
<?php require_once("../conexao/session.php"); ?>
<?php
    
    if( isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
        $senha   = $_POST["senha"];

        $login = "SELECT * ";
        $login .= "FROM usuarios ";
        $login .= "WHERE email = '{$usuario}' and senha = '{$senha}' ";

        $acesso = mysqli_query($conecta, $login);
        if(!$acesso){
            die("Falha na consulta ao banco!");
        }

        $informacao = mysqli_fetch_assoc($acesso);

        if( empty($informacao) ) {
            $mensagem = "Login Incorreto.";
        }else {
            $_SESSION["acesso_usuario"] = $informacao["id"];
            header("location:main_principal.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <main>

        <div id="tittleLogin">
            <h1 style="font-size: 50px; color: black"><strong>CONTROLE DE USUARIOS</strong></h1>
        </div>
        <div id="logar">
        <form classs="form-group" action="login.php" method="post">
            <div class="form-group">
            <h1 style="text-align: center; padding-bottom: 10px"><strong>LOGIN</strong></h1>
            <label for="nome">E-mail</label>
            <input class="form-control" type="text" name="usuario" placeholder="Usuario">
            </div>  

            <div class="form-group">
            <label for="nome">Senha</label>
            <input class="form-control" type="password" name="senha" placeholder="senha">
            </div>
                    
            <input class="btn btn-primary" type="submit" value="login">

            <?php
                if( isset($mensagem)){
            ?>
                <p style="color: red;"><strong><?php echo $mensagem ?></strong></p>

            <?php
                }
            ?>
            <h5><a href="cad_usu_login.php">Não tem cadastro? Clique Aqui!</a></h5>
        </form>
        </div>
    </main>    

</body>
</html>
 