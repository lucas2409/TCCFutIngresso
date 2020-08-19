<?php
    session_start();
    $result;    
    //$_SESSION['nome_usuario'];
    //$_SESSION['login_usuario'];
    
    function PesqJogo(){
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
            $sql = ("SELECT * FROM jogosdisponiveis WHERE disponivel = 1");
            $resu = mysql_query($sql,$conexao);

            //valida se a query está valida e efetua o redirecionamento.
            if(mysql_query($sql, $conexao)){
                echo "<html><head><meta charset='UTF-8'><title>
                    FutIngresso - Seu ingresso rápido e facil</title>
                    <link href='css/menu.css' rel='stylesheet'>
                    <link href='css/camposdeTexto.css' rel='stylesheet'>
                    <link href='css/botoes.css' rel='stylesheet'>
                    <link href='css/forms.css' rel='stylesheet'>
                    <link href='css/tabela.css' rel='stylesheet'>
                    </head><body id='body'><nav><ul class='menu'>
                    <li><a href='index.html'>Home</a></li>
                    <li><a href='login.html'>Login</a></li>
                    <li><a href='ListarJogo.php'>Comprar Ingressos</a></li>
                    <li><a href='historicoJogos.php'>Historico de Compra</a></li>
                    <li><a href='sobreFutIngresso.html'>Sobre</a></li>";
                while($pesq=mysql_fetch_array($resu)){                  
                    $cod = $pesq['codJogo'];
                    $dtjogo = $pesq['DataJogo'];
                    $mandante = $pesq['timeMandante'];
                    $visitante = $pesq['timeVisitante'];
                    $estadio = $pesq['LocalEstadio'];
                    echo "</ul><hr></nav><br><br><br><br><br>
                    <form action='finalizarCompra.php' method='POST'>
                    <table class='tabe' align='center'><th align='center'> Codigo </th>
                    <th align='center'> Data do Jogo </th>
                    <th align='center'> Torcida </th><th align='center'> Mandante </th>
                    <th align='center'> Visitante </th><th align='center'> Local estadio </th>
                    <th align='center'> Comprar </th><tr align='center'>
                    <td> <input type='text' name='cod' id='cod' readonly value='".$cod."'></td>
                    <td> <input type='text' name='dtjogo' id='dtjogo' readonly value='".$dtjogo."'></td>
                    <td> 
                    <select name='torcida' id='torcida'>
                        <option value='Mandante'>Mandante</option> 
                        <option value='Visitante'>Visitante</option>
                    </select>
                    </td>
                    <td> <input type='text' name='mandante' id='mandante' readonly value='".$mandante."'></td>
                    <td> <input type='text' name='visitante' id='visitante' readonly value='".$visitante."'></td>
                    <td> <input type='text' name='estadio' id='estadio' readonly value='".$estadio."'></td>
                    <td><select name='quantIngresso' id='quantIngresso'><option name='valor1' value='1'>1</option> 
                    <option name='valor2' value='2'>2</option><option name='valor3' value='3'>3</option>
                    <option name='valor4' value='4'>4</option><option name='valor5' value='5'>5</option>
                    <option name='valor6' value='6'>6</option><option name='valor7' value='7'>7</option>
                    <option name='valor8' value='8'>8</option><option name='valor9' value='9'>9</option>
                    <option name='valor10' value='10'>10</option></td>
                    </select><td class='td'><br><button type='submit' class='botao botao-btn-info' 
                    onclick='' >Comprar Ingresso</button><br><br></td>
                    </tr></table><br><br></form></body></html>";
                }
            }
            else{
                echo "<script>alert('Erro ao consultar! Por favor contate o desenvolvedor!');</script>";
                echo "<script>location.href='cadJogo.html'</script>";
            }    
        }
        mysql_close($conexao);
    } 
    $result = PesqJogo();
?>