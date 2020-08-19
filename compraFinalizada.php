<?php
    session_start();
    $result;
    date_default_timezone_set('America/Sao_Paulo');
    $dttent = date('d/m/Y');
    $dtcom = strval($dttent);
    $torc = $_POST['torcida'];
    $cart = $_POST['numero'];
    $titu = $_POST['titular'];
    $dtvc = $_POST['dtvenc'];
    $codvv = $_POST['cvv'];
    $qIngresso = $_POST['ingresso'];
    $valorCompra = $_POST['valor'] ;
    
    function CadCompra($login, $codjogo, $torcida, $dtcompra, $cartao, $titular, $dtvenc, $cvv, $quantIngresso, $valor){
        //estabilizando conexão com servidor
        $conexao = mysql_connect("localhost" , "root" , "root" ) or die ("Erro ao conectar"); 
        //verificando mais algum erro e redirecionando para o Login novamente
        if(!$conexao){
            echo "<script>alert('Erro ao conectar! contate o adm.');</script>";
            echo "<script>location.href='login.html'</script>";               
        }
        //em caso de não houver erro irá seguir para validação de usuário
        else{
            if($torcida == "Mandante"){
                $trcd = 1;
            }
            else{
                $trcd = 2;
            }
            //conectando com o respectivo banco do servidor
            mysql_select_db("futingresso", $conexao);
            //query
            $sql = ("SELECT * FROM usuarios WHERE email= '".$login."'");
            //este código junta a query + a conexão
            $resu = mysql_query($sql,$conexao);
            //recebendo resultados da consulta
            $codUser = mysql_result($resu,0,"codigoUsuario");
            //fazendo INSERT carrinho de compra
            $sql = ("INSERT INTO carrinhocompra(codUsuario, codJogo, tipoTorcida, DataCompra, \n
            NumeroCartao, TitularCartao, dataVenc, codCVV, quantingresso, valorcompra)VALUES(".$codUser.",".$codjogo." , " .$trcd." \n
             , '".$dtcompra."' , '".$cartao."' , '".$titular."' , '".$dtvenc."' , '".$cvv."' , \n
             ".$quantIngresso." , ".$valor.")");
             //este código junta a query + a conexão
            if(mysql_query($sql,$conexao)){
                echo "<html><head><meta charset='UTF-8'><title>
                    FutIngresso - Seu ingresso rápido e facil</title>
                    <link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                    <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                    </head><body id='body'><nav><ul class='menu'><li><a href='index.html'>Home</a></li>
                    <li><a href='login.html'>Login</a></li><li><a href='ListarJogo.php'>Comprar Ingressos</a></li>
                    <li><a href='#'>Historico de Compra</a></li><li><a href='sobreFutIngresso.html'>Sobre</a></li>
                    </ul><hr></nav><br><br><br><br><br><center><form id='formLogin' action='' method='POST'>
                    <div><cente><b><a>Compra cadastrada!</a></b><b><a>Obrigado por utilizar o FutIngresso!</a></b>
                    </cente></div></form></center></body></html>";
            }
            else{
                echo "<html><head><meta charset='UTF-8'><title>
                    FutIngresso - Seu ingresso rápido e facil</title>
                    <link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                    <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                    </head><body id='body'><nav><ul class='menu'><li><a href='index.html'>Home</a></li>
                    <li><a href='login.html'>Login</a></li><li><a href='ListarJogo.php'>Comprar Ingressos</a></li>
                    <li><a href='#'>Historico de Compra</a></li><li><a href='sobreFutIngresso.html'>Sobre</a></li>
                    </ul><hr></nav><br><br><br><br><br><center><form id='formLogin' action='' method='POST'>
                    <div><cente><b><a>Compra Não cadastrada!
                    </a></b><b><a>Por favor entre em contato com o Adm : adm@futingresso.com!</a></b>
                    </cente></div></form></center></body></html>";
            }
        }
    }
    $result = CadCompra($_SESSION['login_usuario'], $_SESSION['codigo_jogo'], $torc, $dtcom, $cart, $titu, $dtvc, $codvv,$qIngresso, $valorCompra);
?>