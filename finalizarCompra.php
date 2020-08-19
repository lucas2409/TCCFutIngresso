<?php
    session_start();
    $result;
    $cod = $_POST['cod'];
    $dtjogo = $_POST['dtjogo'];
    $local = $_POST['estadio'];
    $quantIngresso = $_POST['quantIngresso'];
    $torcida = $_POST['torcida'];
    $_SESSION['codigo_jogo'] = $cod; 
    
    function CalcularValor($codigo, $datajogo, $estadio, $torc, $qIngresso){
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
               //query
               $sql = ("SELECT * FROM jogosdisponiveis WHERE codJogo= ".$codigo."");
               //este código junta a query + a conexão
               $resu = mysql_query($sql,$conexao);
               //recebendo resultados da consulta
               $vlrMand = mysql_result($resu,0,"valorMandante");
               $vlrVisit = mysql_result($resu,0,"valorVisitante");

               if($torc == 'Mandante'){
                    $total = $qIngresso * $vlrMand;
               }
               else{
                    $total = $qIngresso * $vlrVisit;
               }
               echo "<html><head><meta charset='UTF-8'><title>
                    FutIngresso - Seu ingresso rápido e facil
                    </title><link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css'
                    rel='stylesheet'><link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css'
                    rel='stylesheet'><link href='css/tabela.css' rel='stylesheet'></head><body id='body'>
                    <nav><ul class='menu'><li><a href='index.html'>Home</a></li><li><a href='login.html'>Login
                    </a></li><li><a href='ListarJogo.php'>Comprar Ingressos</a></li><li><a href='historicoJogos.php'>
                    Historico de Compra</a></li><li><a href='sobreFutIngresso.html'>Sobre</a></li>
                    </ul><hr></nav><br><br><br><br><br><center><form action='compraFinalizada.php' method='POST' ><table><th align='center'> Nome </th>
                    <th align='center'> E-mail </th><tr align='center'><td>".$_SESSION['nome_usuario']."</td><td>".$_SESSION['login_usuario']."</td></tr>
                    </table><br><table><th align='center'> Codigo </th><th align='center'> Data do Jogo </th>
                    <th align='center'> Local estadio </th>
                    <th align='center'> Quantidade Ingresso </th>
                    <tr align='center'><td>".$codigo."</td><td>".$datajogo."
                    </td><td>".$estadio."</td>
                    <td>
                    <input type='text' name='ingresso' id='ingresso' readonly value=".$qIngresso.">
                    </td>
                    </tr></table><br> 
                    <table align='center'>
                    <th> Torcida </th>
                    <th> Valor </th>
                    <tr align='center'>
                        <td>
                            <input type='text' name='torcida' id='torcida' readonly value=".$torc.">
                        </td>
                        <td>
                            <input type='text' name='valor' id='valor' readonly value=".$total.">
                        </td>
                    </tr>
                    </table><br>
                    <table align='center'>
                    <th align='center'> Comprar - Cartão </th><tr align='center'><td><br><a>Titular do Cartão</a>
                    <input type='text' name='titular' id='titular'><br></td><td><br><a>Número do Cartão</a>
                    <input type='text' name='numero' id='numero'><br></td><td><br><a>CVV</a>
                    <input type='text' name='cvv' id='cvv'><br></td><td><br><a>Data de Vencimento Cartão</a>
                    <input type='text' name='dtvenc' id='dtvenc'><br></td></tr></table><br>
                    <button type='submit' class='botao botao-btn-conf' >Confirmar</button><br><br>
                    </form><button type='submit' class='botao botao-btn-canc' onclick=location.href='ListarJogo.php' >Cancelar</button><br><br></center></body></html>";
           }
    }

    $result = CalcularValor($cod, $dtjogo, $local, $torcida, $quantIngresso);
?>