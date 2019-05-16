<?php 
    // Passo 1 - ABRIR CONEXÃO 
    $servidor   = "localhost";
    $usuario    = "root";
    $senha      = "";
    $banco      = "CRUD";
    $conecta    = mysqli_connect($servidor,$usuario,$senha,$banco);

    //Passo 2 - TESTAR CONEXAO
    if(mysqli_connect_errno() ){
        die("Conexao falhou: " . mysqli_connect_errno()); 
    }
    
?>