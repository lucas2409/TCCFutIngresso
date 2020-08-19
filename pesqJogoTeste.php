<?php
    $result;

    Function PesqJogo(){
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
            $sql = ("SELECT * FROM jogosdisponiveis");
            $resu = mysql_query($sql,$conexao);

            //valida se a query está valida e efetua o redirecionamento.
            if(mysql_query($sql, $conexao)){
                echo "<table><th align='center'> Mandante </th>
                        <th align='center'> Visitante </th><th align='center'> Local estadio </th>
                        <th align='center'> Comprar </th><tr align='center'>";
                while($pesq=mysql_fetch_array($resu)){
                    $mandante = $pesq['timeMandante'];
                    $visitante = $pesq['timeVisitante'];
                    $estadio = $pesq['LocalEstadio'];
                    echo "<td>".$mandante."</td>
                        <td>".$visitante."</td>
                        <td>".$estadio."</td>
                        <td><button>Teste</button></td></table>";
                }
            }
            else{
                echo "<script>alert('Erro ao cadastrar! Por favor contate o desenvolvedor!');</script>";
                echo "<script>location.href='cadJogo.html'</script>";
            }    
        }
        mysql_close($conexao);
    } 
    $result = PesqJogo();

?>