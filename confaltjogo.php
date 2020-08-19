<?php
    session_start();
    $result;
    $cod = $_POST["cod"];
    $_SESSION['codigo'] = $cod; 
    function altjogo($codigo){
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
            $sql = ("SELECT * FROM jogosdisponiveis WHERE codJogo = ".$codigo."");
            $resultado = mysql_query($sql,$conexao);
            $mandante = mysql_result($resultado,0,"timeMandante");
            $visitante = mysql_result($resultado,0,"timeVisitante");
            $local = mysql_result($resultado,0,"LocalEstadio");
            $quantCasa = mysql_result($resultado,0,"IngressosMandante");
            $quantVisit = mysql_result($resultado,0,"IngressosVisitante");
            $dtJogo = mysql_result($resultado,0,"DataJogo");
            $valorMandante = mysql_result($resultado,0,"valorMandante");
            $valorVisitante =  mysql_result($resultado,0,"valorVisitante");
            $desc = mysql_result($resultado,0,"Descricao");
            $disp = mysql_result($resultado,0,"disponivel");
            if($resultado){
                echo "<html><head><meta charset='UTF-8'><title>
                FutIngresso - Seu ingresso rápido e facil</title>       
                <link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                </head><body id='body'><nav><ul class='menu'><li><a href='index.html'>Home</a></li>
                <li><a href='cadJogo.html'>Cadastrar Jogo</a></li><li><a href='altjogo.php'>Alterar Jogos</a></li>
                <li><a href='altUser.php'>Alterar Usuários</a></li><li><a href='PainelVendas.php'>Vendas</a></li></ul><hr>
                </nav><br><br><br><br><br><center><form id='formVendas' method='POST' action='update.php'>
                <div><table><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Mandante</a>
                <input type='text' name='clubeA' id='clubeA' value='".$mandante."'></td><br><br><td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a>Visitante</a><input type='text' name='clubeB' id='clubeB' value='".$visitante."'></td><td>&nbsp;&nbsp;&nbsp;
                <a>Estádio</a><input type='text' name='estadio' id='estadio' value='".$local."'></td></tr><tr></tr><tr></tr>
                <tr></tr><tr></tr><tr><td>&nbsp;<a>Ingressos Casa</a>
                <input type='text' name='quantCasa' id='quantCasa' value='".$quantCasa."'></td><td><a>Ingressos Vistante</a>
                <input type='text' name='quantVisit' id='quantVisit' value='".$quantVisit."'></td><td><a>Data Jogo</a>
                <input type='text' name='dtjogo' id='dtjogo' value='".$dtJogo."'></td></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                <tr><td><a>Valor Mandante</a><input type='text' name='valorMandante' id='valorMandante' value='".$valorMandante."'></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Valor Visitante</a><input type='text' name='valorVisitante' id='valorVisitante' value='".$valorVisitante."'>
                </td>";
                    if($disp == 1){
                       echo "<td>Disponivel <select name='disp' id='disp'><option>Sim</option><option>Não</option></select>";
                    }   
                    else
                    {
                        echo "<td>Disponivel <select name='disp' id='disp'><option>Não</option><option>Sim</option></select>";
                    }             
                echo "</td></tr><tr><td><a>Descrição:</a><textarea name='desc' id='desc'>".$desc."</textarea><br></td>   
                </tr></table><br><br><button type='submit' class='botao botao-btn-info' >Cadastrar</button>&nbsp;
                </div></form><button type='submit' class='botao botao-btn-canc' onclick=location.href='altjogo.php'>Voltar</button><br></center></body></html>";
            }
            else{
                echo "<script>alert('Jogo não localizado')</script>";
                echo "<script>location.href='cadJogo.html'</script>";
            }
        }
    }

    $result = altjogo($cod);
    
?>