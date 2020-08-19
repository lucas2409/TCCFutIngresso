<?php
    session_start();
    $result;    
    $mand = $_POST['dtMand'];
    $_SESSION['nome_usuario'];
    $_SESSION['login_usuario'];

    Function PesqJogo($login, $mandan){
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
            //query de consulta
            $sql = ("SELECT * FROM usuarios WHERE email ='".$login."'");            
            if(mysql_query($sql, $conexao)){
                $cod = mysql_result(mysql_query($sql, $conexao),0,"codigoUsuario");
                //query de consulta
                $sql = ("SELECT * FROM carrinhocompra AS c  INNER JOIN  jogosdisponiveis AS j \n
                ON c.codJogo = j.codJogo WHERE c.codUsuario =".$cod." AND j.timeMandante='".$mandan."'");
                //valida se a query está valida e efetua o redirecionamento.
                $resu = mysql_query($sql,$conexao);
                if(mysql_query($sql, $conexao)){
                   echo "<html><head><meta charset='UTF-8'><title>
                        FutIngresso - Seu ingresso rápido e facil</title>
                        <link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                        <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                        <link href='css/tabela.css' rel='stylesheet'></head>
                        <body id='body'><nav>
                        <ul class='menu'><li><a href='index.html'>Home</a></li><li><a href='login.html'>Login</a></li>
                        <li><a href='ListarJogo.php'>Comprar Ingressos</a></li><li><a href='historicoJogos.php'>Historico de Compra</a></li>
                        <li><a href='sobreFutIngresso.html'>Sobre</a></li></ul><hr></nav><br><br><br>
                        <form action='historicoDefinido.php' method='POST'><table><tr>
                        </td><td>Pesquisar Mandante:<input type='text' name='dtMand' id='campo'>
                        </td><td class='td'><br><button type='submit' class='botao botao-btn-info' onclick=''>Pesquisar</button><br><br>
                        </td></tr></table><br></form>";
                    while($pesq=mysql_fetch_array($resu)){
                        $codigo = $pesq['codJogo'];
                        $datajogo = $pesq['DataJogo'];
                        $mandante = $pesq['timeMandante'];
                        $visitante = $pesq['timeVisitante'];
                        $torcida = $pesq['tipoTorcida'];
                        $local = $pesq['LocalEstadio'];
                        $quant = $pesq['quantingresso'];
                        $valor = $pesq['valorcompra'];
                        echo "<form><table class='tabe'><th align='center'> Codigo </th>
                            <th align='center'> Data do Jogo </th><th align='center'> Mandante </th>
                            <th align='center'> Visitante </th><th align='center'> Torcida </th>
                            <th align='center'> Local estadio </th><th align='center'> Quantidade de Ingressos </th>
                            <th align='center'> Valor da Compra </th><tr align='center'><td>".$codigo."</td>
                            <td>".$datajogo."</td><td>".$mandante."</td><td>".$visitante."</td><td>".$torcida."
                            </td><td>".$local."</td><td>".$quant."</td><td>".$valor."</td></tr></table></form></body></html>";
                    }
                }
                else{
                    echo "<script>alert('Erro ao consultar! Por favor contate o desenvolvedor!');</script>";
                    echo $_SESSION['login_usuario'];
                }    
            }
            else{
                echo "compra não localizada";
            }
        }
        mysql_close($conexao);
    } 
    $result = PesqJogo($_SESSION['login_usuario'], $mand);
?>