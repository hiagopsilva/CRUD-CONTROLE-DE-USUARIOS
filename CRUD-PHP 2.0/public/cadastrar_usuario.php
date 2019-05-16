<?php require_once("../conexao/conexao.php"); ?>
<?php require_once("../conexao/session.php"); ?>
<?php

    // Teste de segurança 
    if( !isset($_SESSION["acesso_usuario"])) {
        header("location:login.php");
    } 

    if( isset($_POST["nome"])) {
        $nome       = utf8_decode($_POST["nome"]);
        $email      = utf8_decode($_POST["email"]);
        $senha      = utf8_decode($_POST["senha"]);
        $telefone   = $_POST["telefone"];

        $inserir    = "INSERT INTO usuarios ";  
        $inserir    .= "(nome,email,senha,telefone) ";  
        $inserir    .= "VALUES ";  
        $inserir    .= "('$nome','$email','$senha',$telefone) ";  

        $operacao_inserir = mysqli_query($conecta,$inserir);

        if(!$operacao_inserir) {
            die ("Erro ao cadastrar o usuario!!");
        } else {
            echo "<script>alert('usuario cadastrado com sucesso!!');</script>";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar Usuario</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">

    <div id="header_central">
        <?php
            if( isset($_SESSION["acesso_usuario"])) {
                $user = $_SESSION["acesso_usuario"];

                $saudacao = "SELECT nome ";
                $saudacao .= "FROM usuarios ";
                $saudacao .= "WHERE id = {$user}";

                $saudacao_login = mysqli_query($conecta,$saudacao);
                if(!$saudacao_login){
                    die("Falha no banco");
                }

                $saudacao_login = mysqli_fetch_assoc($saudacao_login);
                $nome = $saudacao_login["nome"];

                
        ?>
        

        <nav class="navbar navbar-default navbar-top">
            <section class="container">
                <div class="navbar-header" style="margin-top: 10px;"> 
                    <h4 style="display: block;" >
                        <a href="main_principal.php">
                            <strong class="titulo-principal">
                                CONTROLE DE USUARIOS
                            </strong>
                        </a>
                    </h4>
                </div> 

                <div class="collapse navbar-collapse pull-right ">
                    
                    <ul class="nav navbar-nav">
                        <li>
                            <div id="header_saudacao">
                                <h5 style="width: 150px; text-align: center;">Bem Vindo, <strong><?php echo $nome ?></strong></h5>
                            </div>
                        </li>   
                        <li><a href="main_principal.php">Menu</a></li>
                        <li class="nav-item active"><a href="Cadastrar_usuario.php">Cadastrar</a></li>
                        <li><a href="mostrar_usuarios.php">Lista de Usuarios</a></li>
                        <!-- <li><a href="alterar_usuarios.php">Atualizar</a></li>
                        <li><a href="excluir_usuario.php">Excluir</a></li> -->
                        
                    </ul>
                    <button type="button" class="btn btn-primary navbar-btn">
                        <a href="logout.php" style="color: white">LogOut</a>
                    </button>
                </div>
            </section>
        </nav>


        <?php 
            }
        ?>

    </div>
</head>
<body>
    
    <form id="form-cadastro" action="cadastrar_usuario.php" method="post" >

        <div id="tittle">
            <h1>Cadastrar Usuario</h1>
        </div>
        
        <hr>

        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input class="form-control" type="text" name="nome" placeholder="nome">
        </div>
        
        <div class="form-group">
            <label for="email">E-mail de Login</label>
            <input class="form-control" type="text" name="email" placeholder="email">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input class="form-control"type="password" name="senha" placeholder="senha">
        </div>

        <div class="form-group">
            <label for="Telefone">Telefone</label>
            <input class="form-control"type="text" name="telefone" placeholder="telefone">
        </div>
        <input class="btn btn-success" type="submit" name="inserir">
        
    </form>
</body>
</html>

