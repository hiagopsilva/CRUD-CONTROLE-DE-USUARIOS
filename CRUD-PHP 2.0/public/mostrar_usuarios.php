<?php require_once("../conexao/conexao.php"); ?>
<?php require_once("../conexao/session.php"); ?>

<?php

    // Teste de segurança 
    if( !isset($_SESSION["acesso_usuario"])) {
        header("location:login.php");
    } 
    
    //Consulta ao banco de dados
    $usuarios = "SELECT id, nome, email, senha, telefone ";
    $usuarios .= " FROM usuarios ";

    if( isset($_GET["usuarios"]) ) {
        $nome_usuario = $_GET["usuarios"];
        $usuarios .= "WHERE nome like '%{$nome_usuario}%' ";
        
    }
    $resultado = mysqli_query($conecta,$usuarios);
    if(!$resultado) {
        die("Falha ao mostrar lista de usuarios");
    }
        
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Usuarios</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"> -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">


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
                <div class="navbar-header"  style="margin-top: 5px;"> 
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
                                <h5 style="width: 150px; text-align: center; margin-top: 5px">Bem Vindo, <strong> <?php echo $nome ?> </strong></h5>
                            </div>
                        </li>   
                        <li><a href="main_principal.php">Menu</a></li>
                        <li><a href="Cadastrar_usuario.php">Cadastrar</a></li>
                        <li class="nav-item active"><a href="mostrar_usuarios.php">Lista de Usuarios</a></li>
                        <!-- <li><a href="alterar_usuarios.php">Atualizar</a></li>
                        <li><a href="excluir_usuario.php">Excluir</a></li> -->
                        <li><p>   </p></li>
                        
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
            <form id="form-cadastro" action="mostrar_usuarios.php" method="get">
            
                <div id="tittle-lista">
                    <h1>Lista de Usuarios</h1>
                    <hr>
                </div>
                
                <div class="form-inline">
                    <div class="input-group">
                        <input class="form-control" type="text" name="usuarios" placeholder="Pesquisar Usuarios" style="width: 530px; border-radius:4px; margin-left: 30px">
                    </div>

                <div class="input-group">
                    <button type="image" class="btn btn-success fa fa-search" name="pequisa" style="padding: 9px; padding-left: 30px; padding-right: 30px;"> </button>
                </div>
                </div> 
            </form>
        </div>


        <?php
            while($linha = mysqli_fetch_assoc($resultado)){
        ?>
            <ul id="form-cadastro">
                <li class="list-group-item active" style="padding: 0px; "><strong><h4 style="margin-left: 10px">ID: <?php echo $linha["id"]?></h4></strong></li>
                
                <li class="list-group-item"><strong>Nome: </strong><?php echo $linha["nome"]?></li>

                <li class="list-group-item"><strong>E-mail: </strong><?php echo $linha["email"]?></li>
                
                <li class="list-group-item"><strong>Senha: </strong><?php echo $linha["senha"]?></li>
                
                <li class="list-group-item"><strong>Telefone: </strong><?php echo $linha["telefone"]?></li>
                
                <div id="espaco">
                <li class="btn btn-primary"><a href="alterar_usuarios.php?id=<?php echo $linha["id"] ?>"  style="color: white;">Alterar</a> </li>

                <li class="btn btn-danger" ><a href="excluir_usuario.php?id=<?php echo $linha["id"] ?>" style="color: white;">Excluir</a> </li>
                </div>
            </ul>

        <?php
            }
        ?>
        
    </main>
    
</body>
</html>