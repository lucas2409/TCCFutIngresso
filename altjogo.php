<?php
    session_start();
    error_reporting(0);
    $resul;

    function pesqJogo(){
        //estabilizando conexão com servidor
        $conexao = mysql_connect("localhost" , "root" , "root" ) or die ("Erro ao conectar"); 
        //verificando mais algum erro e redirecionando para o Login novamente
        if(!$conexao){
            echo "<script>alert('Erro ao conectar! contate o adm.');</script>";
            echo "<script>location.href='login.html'</script>";               
        }
        //em caso de não houver erro irá seguir para validação de usuário
        else{
            $mandante = $_POST['Mand'];
            if($mandante == ''){
                //conectando com o respectivo banco do servidor
                mysql_select_db("futingresso", $conexao);
                //query de consulta
                $sql = ("SELECT * FROM jogosdisponiveis ");
                $resultado = mysql_query($sql, $conexao);
                if($resultado){
                    echo "<html><head><meta charset='UTF-8'><title>FutIngresso - Seu ingresso rápido e facil
                    </title><link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                    <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                    <link href='css/tabela.css' rel='stylesheet'></head><body id='body'><nav><ul class='menu'>
                    <li><a href='index.html'>Home</a></li><li><a href='cadJogo.html'>Cadastrar Jogo</a></li>
                    <li><a href='altjogo.php'>Alterar jogos</a></li><li><a href='altUser.php'>Alterar Usuarios</a></li>
                    <li><a href='PainelVendas.php'>Vendas</a></li></ul><hr></nav><br><br><br><br><br>
                    <form action='altjogo.php' method='POST'><table class='tabe' align='center'><tr><td>Pesquisar Mandante:<input type='text' name='Mand' id='Mand'>
                    </td><td class='td'><br><button type='submit' class='botao botao-btn-info' onclick='' >Pesquisar</button><br><br>
                    </td></tr></table></form>";
                    while($pesq=mysql_fetch_array($resultado)){
                        $cod = $pesq['codJogo'];
                        $dtjogo = $pesq['DataJogo'];
                        $mand = $pesq['timeMandante'];
                        $visit = $pesq['timeVisitante'];
                        $local = $pesq['LocalEstadio'];
                        $disp = $pesq['disponivel'];
                        if($disp==1){
                            $dispo = 'Sim';
                        }
                        else{
                            $dispo = 'Não';
                        }
                        echo "<form action='confaltjogo.php' method='POST'>
                        <table class='tabe' align='center'>
                        <th align='center'> Codigo </th>
                        <th align='center'> Data do Jogo </th>
                        <th align='center'> Mandante </th>
                        <th align='center'> Visitante </th>
                        <th align='center'> Local estadio </th>
                        <th align='center'> Jogo Disponível </th>
                        <tr align='center'>
                        <td class='td'><input type='text' name='cod' id='cod' value='".$cod."'></td>
                        <td class='td'><input type='text' readonly name='dtjogo' id='dtjogo' value='".$dtjogo."'></td>
                        <td class='td'><input type='text' readonly name='mand' id='mand' value='".$mand."'></td>
                        <td class='td'><input type='text' readonly name='visit' id='visit' value='".$visit."'></td>
                        <td class='td'><input type='text' readonly name='local' id='local' value='".$local."'></td>
                        <td class='td'><input type='text' readonly name='disp' id='disp' value='".$dispo."'></td>
                        <td><button type='submit' class='botao botao-btn-info' >Alterar</button></td>
                        </tr></table></form></body></html>";
                    }
                }
                else{
                    echo "<html><head><meta charset='UTF-8'><title>
                        FutIngresso - Seu ingresso rápido e facil</title>
                        <link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                        <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                        </head><body id='body'><nav><hr><ul class='menu'>
                        <li><a href='index.html'>Home</a></li><li><a href='cadJogo.html'>Cadastrar Jogo</a></li>
                        <li><a href='aljogo.php'>Alterar jogos</a></li><li><a href='altUser.php'>Alterar Usuarios</a></li>
                        <li><a href='PainelVendas.php'>Vendas</a></li></ul></nav><br><br><br><br><br><center><form id='formLogin' action='' method='POST'>
                        <div><cente><b><a>Não existem jogos cadastrados!</a></b><b><a></a></b>
                        </cente></div></form></center></body></html>";
                }
            }
            else{
                //conectando com o respectivo banco do servidor
                mysql_select_db("futingresso", $conexao);
                //query de consulta
                $sql = ("SELECT * FROM jogosdisponiveis WHERE timeMandante ='".$mandante."'");
                $resultado = mysql_query($sql, $conexao);
                if($resultado){
                    echo "<html><head><meta charset='UTF-8'><title>FutIngresso - Seu ingresso rápido e facil
                    </title><link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                    <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                    <link href='css/tabela.css' rel='stylesheet'></head><body id='body'><nav><ul class='menu'>
                    <li><a href='index.html'>Home</a></li><li><a href='cadJogo.html'>Cadastrar Jogo</a></li>
                    <li><a href='altjogo.php'>Alterar jogos</a></li><li><a href='altUser.php'>Alterar Usuarios</a></li>
                    <li><a href='PainelVendas.php'>Vendas</a></li></ul><hr></nav><br><br><br><br><br>
                    <form><table class='tabe' align='center'><tr><td>Pesquisar Mandante:<input type='text' name='Mand' id='Mand'>
                    </td><td class='td'><br><button type='submit' class='botao botao-btn-info' onclick='' >Pesquisar</button><br><br>
                    </td></tr></table></form>";
                    while($pesq=mysql_fetch_array($resultado)){
                        $cod = $pesq['codJogo'];
                        $dtjogo = $pesq['DataJogo'];
                        $mand = $pesq['timeMandante'];
                        $visit = $pesq['timeVisitante'];
                        $local = $pesq['LocalEstadio'];
                        $disp = $pesq['disponivel'];
                        if($disp==1){
                            $dispo = 'Sim';
                        }
                        else{
                            $dispo = 'Não';
                        }
                        echo "<form action='confaltjogo.php' method='POST'>
                        <table class='tabe' align='center'>
                        <th align='center'> Codigo </th>
                        <th align='center'> Data do Jogo </th>
                        <th align='center'> Mandante </th>
                        <th align='center'> Visitante </th>
                        <th align='center'> Local estadio </th>
                        <th align='center'> Jogo Disponível </th>
                        <tr align='center'>
                        <td class='td'><input type='text' name='cod' id='cod' value='".$cod."'></td>
                        <td class='td'><input type='text' readonly name='dtjogo' id='dtjogo' value='".$dtjogo."'></td>
                        <td class='td'><input type='text' readonly name='mand' id='mand' value='".$mand."'></td>
                        <td class='td'><input type='text' readonly name='visit' id='visit' value='".$visit."'></td>
                        <td class='td'><input type='text' readonly name='local' id='local' value='".$local."'></td>
                        <td class='td'><input type='text' readonly name='disp' id='disp' value='".$dispo."'></td>
                        <td><button type='submit' class='botao botao-btn-info' >Alterar</button></td>
                        </tr></table></form></body></html>";
                    }
                }
                else{
                    echo "<html><head><meta charset='UTF-8'><title>
                        FutIngresso - Seu ingresso rápido e facil</title>
                        <link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                        <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                        </head><body id='body'><nav><hr><ul class='menu'>
                        <li><a href='index.html'>Home</a></li><li><a href='cadJogo.html'>Cadastrar Jogo</a></li>
                        <li><a href='aljogo.php'>Alterar jogos</a></li><li><a href='altUser.php'>Alterar Usuarios</a></li>
                        <li><a href='PainelVendas.php'>Vendas</a></li></ul></nav><br><br><br><br><br><center><form id='formLogin' action='' method='POST'>
                        <div><cente><b><a>Não existem jogos cadastrados!</a></b><b><a></a></b>
                        </cente></div></form></center></body></html>";
                }
            }
        }
    }
    $resul = pesqJogo();
    
?>