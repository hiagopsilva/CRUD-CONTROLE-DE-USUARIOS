<?php require_once("../conexao/conexao.php"); ?>
<?php require_once("../conexao/session.php"); ?>
<?php
    // Teste de segurança 
    if( !isset($_SESSION["acesso_usuario"])) {
        header("location:login.php");
    } 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">

    <?php require_once("../incluir/topo.php"); ?>

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
                                <h5 style="width: 150px; text-align: center; margin-top: 5px">Bem Vindo, <strong><?php echo $nome ?></strong></h5>
                            </div>
                        </li>   
                        <li class="nav-item active"><a href="main_principal.php">Menu</a></li>
                        <li><a href="Cadastrar_usuario.php">Cadastrar</a></li>
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

    <main>
        <div id="conteudo">
            <div>
                <h1>Bem Vindo</h1>
            </div>
            <div>
                <p>Site desenvolvido com a finalidade de um <strong>CRUD</strong> simples utilizando a linguagem <strong>PHP</strong> no back-End e <strong>HTML, CSS e BOOTSTRAP</strong> no Front-End.</p>
            </div>

            <div id="botao-conteudo">
                <button type="button" class="btn btn-primary">
                    <a href="cadastrar_usuario.php" style="color: white">Cadastrar Usuarios</a>
                </button>
            </div>
        </div>
    </main>
    
</body>
</html>