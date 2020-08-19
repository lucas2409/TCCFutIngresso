<?php
    $result;
    $mandante = $_POST["clubeA"];
    $visitante = $_POST["clubeB"];
    $estadio = $_POST["estadio"];
    $ingressoM = $_POST["quantCasa"];
    $ingressoV = $_POST["quantVisit"];
    $datajogo = $_POST["dtjogo"];
    $vlrMandante = $_POST["valorMandante"];
    $vlrVisitante = $_POST["valorVisitante"];
    $desc = $_POST["desc"];

    Function cadJogo($mand, $visi, $est, $ingMand, $ingVisi, $dataJogo, $valorM, $valorV, $descricao){
        $disp = 1;
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
            $sql = ("INSERT INTO jogosdisponiveis(timeMandante, timeVisitante, LocalEstadio, \n
            IngressosMandante, IngressosVisitante, DataJogo, valorMandante, valorVisitante, \n 
            Descricao, disponivel)VALUES('".$mand."','".$visi."','".$est."','".$ingMand."' , \n
            '".$ingVisi."','".$dataJogo."','".$valorM."','".$valorV."','".$descricao."',".$disp.")");
            //valida se a query está valida e efetua o redirecionamento.
            if(mysql_query($sql, $conexao)){
                echo "<script>alert('Jogo Cadastrado!');</script>";
                echo "<script>location.href='cadJogo.html'</script>";
            }
            else{
                echo "<script>alert('Erro ao cadastrar! Por favor contate o desenvolvedor!');</script>";
                echo "<script>location.href='cadJogo.html'</script>";
            }    
        }
        mysql_close($conexao);
    } 

    if($mandante ==""){
        echo "<script>alert('Erro: Campo mandante está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($visitante ==""){
        echo "<script>alert('Erro: Campo visitante está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($estadio ==""){
        echo "<script>alert('Erro: Campo estadio está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($ingressoM ==""){
        echo "<script>alert('Erro: Campo ingresso mandante está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($ingressoV ==""){
        echo "<script>alert('Erro: Campo ingresso visitante está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($datajogo ==""){
        echo "<script>alert('Erro: Campo data está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($vlrMandante ==""){
        echo "<script>alert('Erro: Campo valor mandante está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($vlrVisitante ==""){
        echo "<script>alert('Erro: Campo valor visitante está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else if($desc ==""){
        echo "<script>alert('Erro: Campo descrição está vazio');</script>";
        echo "<script>location.href='cadJogo.html'</script>";
    }else{
        $result = cadJogo($mandante, $visitante, $estadio, $ingressoM, $ingressoV, $datajogo, $vlrMandante, $vlrVisitante, $desc);    
    }    
?>