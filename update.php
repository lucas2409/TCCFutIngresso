<?php
    session_start();
    $mandante = $_POST['clubeA'];
    $visitante = $_POST['clubeB'];
    $local = $_POST['estadio'];
    $quantCasa = $_POST['quantCasa'];
    $quantVisit = $_POST['quantVisit'];
    $dataJogo = $_POST['dtjogo'];
    $valorMandante = $_POST['valorMandante'];
    $valorVisitante =  $_POST['valorVisitante'];
    $descricao = $_POST['desc'];
    $disp = $_POST['disp'];
    $result;
    $_SESSION['codigo'];

    if($disp=='Sim'){
        $disponivel = 1;
    }
    else{
        $disponivel = 2;
    }

    function alteraJogo($cod, $mand, $visi, $loc, $qcasa, $qvisi, $dtjogo, $vmand, $vvisi, $desc, $disp){
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
            $sql = ("UPDATE jogosdisponiveis SET timeMandante='".$mand."' , timeVisitante='".$visi."' \n
            , LocalEstadio='".$loc."' , IngressosMandante =".$qcasa." , IngressosVisitante=".$qvisi." \n
            , DataJogo='".$dtjogo."' , valorMandante = ".$vmand." , valorVisitante=".$vvisi." \n
            , Descricao = '".$desc."' , disponivel ='".$disp."' WHERE codJogo=".$cod."");
            $resultado = mysql_query($sql,$conexao);
            if($resultado){
                echo "<script>alert('Dados atualizados')</script>";
                echo "<script>location.href='altjogo.php'</script>";
            }
            else{
                echo "<script>alert('Error: Dados não atualizados')</script>";
                echo "<script>location.href='altjogo.php'</script>";
            }
        }
    }

    $result = alteraJogo($_SESSION['codigo'],$mandante, $visitante, $local, $quantCasa, $quantVisit,$dataJogo, $valorMandante, $valorVisitante, $descricao, $disponivel);

?>
