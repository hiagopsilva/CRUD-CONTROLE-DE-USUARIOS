<?php require_once("../conexao/conexao.php"); ?>
<?php require_once("../conexao/session.php"); ?>
<?php
    //Teste de segurança 
    if( !isset($_SESSION["acesso_usuario"])) {
        header("location:login.php");
    } 
    
    if(isset($_POST["nome"])){
        $id         = utf8_decode($_POST["id"]);
        $nome       = utf8_decode($_POST["nome"]);
        $email      = utf8_decode($_POST["email"]);
        $senha      = utf8_decode($_POST["senha"]);
        $telefone   = $_POST["telefone"];

        //Objeto para alterar
        $alterar = "UPDATE usuarios ";
        $alterar .= "SET ";
        $alterar .= "nome = '{$nome}', ";
        $alterar .= "email = '{$email}', ";
        $alterar .= "senha = '{$senha}', ";
        $alterar .= "telefone = '{$telefone}' ";
        $alterar .= "WHERE id = {$id} ";

        $operacao_alterar = mysqli_query($conecta, $alterar); 
        if(!$operacao_alterar) {
            die("Erro na alteração!!");
        }else{
            echo "<script>alert('usuario alterado com sucesso!!');</script>";
            header("location:mostrar_usuarios.php");
        }

    }

    //consulta a tabela de Usuarios
    $usuarios = "SELECT * ";
    $usuarios .= "FROM usuarios ";
    
    if( isset($_GET["id"])) {
        $id = $_GET["id"];
        $usuarios .= "WHERE id = {$id} ";
    }else {
        echo "<script>alert('Usuario não selecionado!!');</script>";
        header("location:mostrar_usuarios.php");
    }
    
    $resultado = mysqli_query($conecta,$usuarios);
    if(!$resultado) {
        die("Erro na consulta!");
    }

    $info_usuarios = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alterar Usuarios</title>

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
                                <h5 style="width: 150px; text-align: center; margin-top: 10px">Bem Vindo, <strong><?php echo $nome ?></strong></h5>
                            </div>
                        </li>   
                        <li><a href="main_principal.php">Menu</a></li>
                        <li><a href="Cadastrar_usuario.php">Cadastrar</a></li>
                        <li><a href="mostrar_usuarios.php">Lista de Usuarios</a></li>
                        <li class="nav-item active"><a href="alterar_usuarios.php">Atualizar</a></li>
                        <!-- <li><a href="excluir_usuario.php">Excluir</a></li> -->
                        
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
    
    <main>
        <div>
            <form id="form-cadastro" action="alterar_usuarios.php" method="post">
                <div id="tittle">
                    <h2>Alterar Usuarios</h2>
                <hr>
                </div>

                <div class="form-group">
                <label for="id">ID:</label>
                <input class="form-control" type="text" value="<?php echo utf8_encode($info_usuarios["id"])?>" name="id" readonly="readonly">
                </div>

                <div class="form-group">
                <label for="nome">Nome:</label>
                <input class="form-control" type="text" value="<?php echo utf8_encode($info_usuarios["nome"])?>" name="nome" id="">
                </div>

                <div class="form-group">
                <label for="email">E-mail:</label>
                <input class="form-control" type="text" value="<?php echo utf8_encode($info_usuarios["email"])?>" name="email" id="">
                </div>

                <div class="form-group">
                <label for="senha">Senha:</label>
                <input class="form-control" type="text" value="<?php echo utf8_encode($info_usuarios["senha"])?>" name="senha" id="">
                </div>

                <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input class="form-control" type="text" value="<?php echo ($info_usuarios["telefone"])?>" name="telefone" id="">
                </div>

                <input class="btn btn-success" type="submit" value="Confirmar alteração">

            </form>

        </div>

    </main>
</body>
</html>