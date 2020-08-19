<?php
    session_start();
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $dica = $_POST['dica'];
    $cadAtivo = $_POST['cadativo'];
    $tipo = $_POST['tipo'];
    $_SESSION['codigo'];
    $result;

    echo "<script>alert(".$tipo.")</script>";
    if($cadAtivo == "Sim"){
        $cadAtivo = 1;
    }
    else{
        $cadAtivo = 2;
    }
    if($tipo == "Administrativo"){
        $tipo = 1;
    }
    else{
        $tipo = 2;
    }

    function upduser($cd, $nm, $em, $dc, $cda, $tp){
        //estabilizando conexão com servidor
        $conexao = mysql_connect("localhost" , "root" , "root" ) or die ("Erro ao conectar"); 
        //verificando mais algum erro e redirecionando para o Login novamente
        if(!$conexao){
            echo "<script>alert('Erro ao conectar! contate o adm.');</script>";
            echo "<script>location.href='login.html'</script>";               
        }
        //em caso de não houver erro irá seguir para validação de usuário
        else{
            //conectando com o respectivo banco do servidor
            mysql_select_db("futingresso", $conexao);
            //query de inserção
            $sql = ("UPDATE usuarios SET Nome='".$nm."' , email='".$em."' , Dicasenha ='".$dc."' \n
            , cadastroAtivo=".$cda.", tipoUsuario=".$tp." WHERE codigoUsuario=".$cd."");
            $resultado=mysql_query($sql,$conexao);
            if($resultado){
                echo "<script>alert('Dados atualizados')</script>";
                echo "<script>location.href='altUser.php'</script>";
            }
            else{
                echo "<script>alert('Dados não atualizados')</script>";
                echo "<script>location.href='altUser.php'</script>";
            }
        }
    }

    $result = upduser($_SESSION['codigo'], $nome, $email, $dica, $cadAtivo, $tipo);

?>