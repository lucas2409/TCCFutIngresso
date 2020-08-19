<?php

    $result;

    function vendas(){
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
            //query de consulta
            $sql = ("SELECT SUM(valorcompra) AS totalvenda FROM carrinhocompra");
            // variavel recebendo valor total
            $valorTotal = mysql_result(mysql_query($sql, $conexao),0,"totalvenda");
            //query de consulta
            $sql = ("SELECT SUM(quantingresso) AS totalingresso FROM carrinhocompra");
            // variavel recebendo valor total
            $ingressosVendidos = mysql_result(mysql_query($sql, $conexao),0,"totalingresso");
            //query da consulta
            $sql = ("SELECT codJogo, COUNT(codJogo) AS Qtd FROM  carrinhocompra GROUP BY codJogo LIMIT 1");
            //recebendo o cod do jogo com mais vendas
            $cod = mysql_result(mysql_query($sql, $conexao),0,"codJogo");
            //query da consulta
            $sql = ("SELECT timeMandante, timeVisitante FROM jogosdisponiveis WHERE codJogo =".$cod."");
            // variavel recebendo mandante e  visitante
            $mandante = mysql_result(mysql_query($sql, $conexao),0,"timeMandante");
            $visitante = mysql_result(mysql_query($sql, $conexao),0,"timeVisitante");
            //query da consulta
            $sql = ("SELECT codUsuario, COUNT(codUsuario) AS Qtd FROM  carrinhocompra GROUP BY codUsuario LIMIT 1");
            //recebendo o cod do jogo com mais vendas
            $cod = mysql_result(mysql_query($sql, $conexao),0,"codUsuario");
            //query da consulta
            $sql = ("SELECT email FROM usuarios WHERE codigoUsuario =".$cod."");
            // variavel recebendo email
            $maiorComprador = mysql_result(mysql_query($sql, $conexao),0,"email");
            
            echo "<html><head><meta charset='UTF-8'>
            <title>FutIngresso - Seu ingresso rápido e facil</title>
            <link href='css/menu.css' rel='stylesheet'>
            <link href='css/camposdeTexto.css' rel='stylesheet'>
            <link href='css/botoes.css' rel='stylesheet'>
            <link href='css/forms.css' rel='stylesheet'>
            <link href='css/tabela.css' rel='stylesheet'>
            </head><body id='body'><nav><ul class='menu'>
            <li><a href='index.html'>Home</a></li><li><a href='cadJogo.html'>Cadastrar Jogo</a></li>
            <li><a href='altjogo.php'>Alterar Jogos</a></li><li><a href='altUser.php'>Alterar Usuario</a></li>
            <li><a href='PainelVendas.php'>Vendas</a></li></ul><hr>
            </nav><br><br><br><form action='' method='POST' ><table class='tabe' align='center'>
            <th align='center'> Valor Total</th><th align='center'>Total de Ingressos Vendidos</th>
            <th align='center'>Jogo mais Vendido</th><th align='center'>Maior Comprador</th>
            <tr align='center'><td>".$valorTotal."</td><td>".$ingressosVendidos."</td><td>".$mandante." x ".$visitante."</td>
            <td>".$maiorComprador."</td></tr></table></form><form action='' method=''>";
            
            //query da consulta
            $sql = ("SELECT c.codJogo, j.DataJogo, j.timeMandante, j.timeVisitante, c.tipoTorcida,  \n
            j.LocalEstadio, c.quantingresso, c.valorcompra, u.email FROM carrinhocompra AS c \n 
            INNER JOIN jogosdisponiveis AS j ON c.codJogo = j.codJogo INNER JOIN usuarios AS u ON \n
            c.codUsuario = u.codigoUsuario");
            //recebendo todos os resultados e listando
            $resu = mysql_query($sql,$conexao);
            if($resu){
                echo "<table class='tabe' align='center'>
                <th align='center'> Cod do Jogo </th>
                <th align='center'> Data do Jogo </th>
                <th align='center'> Time Mandante </th>
                <th align='center'> Time Visitante </th>
                <th align='center'> Torcida Escolhida </th>
                <th align='center'> Local estadio </th>
                <th align='center'> Quantidade de Ingressos </th>
                <th align='center'> Valor da Compra </th>
                <th align='center'> E-mail Comprador </th>
                ";
                while($pesq=mysql_fetch_array($resu)){
                    $cod = $pesq['codJogo'];
                    $dtJogo = $pesq['DataJogo'];
                    $mand = $pesq['timeMandante'];
                    $visi = $pesq['timeVisitante'];
                    $torc = $pesq['tipoTorcida'];
                    if($torc == 1){
                        $torc = "Mandante";
                    }
                    else{
                        $torc = "Visitante";
                    }
                    $loc = $pesq['LocalEstadio'];
                    $quantIngr = $pesq['quantingresso'];
                    $vlrcompra = $pesq['valorcompra'];
                    $compemail = $pesq['email'];
                    echo "<tr align='center'>
                    <td>".$cod."</td>
                    <td>".$dtJogo."</td>
                    <td>".$mand."</td>
                    <td>".$visi."</td>
                    <td>".$torc."</td>
                    <td>".$loc."</td>
                    <td>".$quantIngr."</td>
                    <td>".$vlrcompra."</td>
                    <td>".$compemail."</td></tr>";
                }
                echo "</table><br><br>
                      </form>
                      </body>
                      </html>";
            }
            else{

            }
            

        }
    }

    $result = vendas();

?>