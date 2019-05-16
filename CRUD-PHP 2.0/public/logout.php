<?php require_once("../conexao/conexao.php"); ?>
<?php require_once("../conexao/session.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogOut</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    
    <a class="btn btn-primary" href="login.php" role="button" style="margin-left: 90%; margin-top: 5px">Entre Novamente</a>
</head>
<body id="sair">
    <main>

        <?php
            if( isset($_SESSION["usuario"]) ) {
               echo $_SESSION["usuario"];

            }
        ?>
        <?php
            // Excluir a variavel de sessão mencionada.
            unset($_SESSION["usuario"]);

            //Destroi todas as variaveis de sessão da app.
            session_destroy();
        ?>

        <div class="box">
            <h1>THANKS!</h1>
            <p>por Participar do meu site!</p>
            <p>Até a proxima!!!</p>
            <h3><strong>Hiago Prates</strong></h3>
            <p ><strong>hiagohps360@gmail.com</strong></a></p>
            <p class="btn btn-light"><a href="https://github.com/hiagopsilva">GitHub</a></p>
            

        </div>
    </main>
</body>
</html>