<?php
    $em= $_POST["email"];
    $dc= $_POST["dica"];
    $result;

    function enviaSenha($email,$dica){
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
            $sql = ("SELECT * FROM usuarios WHERE email= '".$email."'");
            //este código junta a query + a conexão
            $resu = mysql_query($sql,$conexao);
            //recebendo resultados da consulta
            $retEmail = mysql_result($resu,0,"email");
            $retDica = mysql_result($resu,0,"Dicasenha");
            $senha = mysql_result($resu,0,"senha");

            if($email == $retEmail){
                if($dica == $retDica){
                    echo "<script>alert('E-mail e Dica localizados!');</script>";
                    echo '<html><head><meta charset="UTF-8"><title>FutIngresso - Seu ingresso rápido e facil</title>       
                        <link href="css/menu.css" rel="stylesheet"><link href="css/camposdeTexto.css" rel="stylesheet">
                        <link href="css/botoes.css" rel="stylesheet"><link href="css/forms.css" rel="stylesheet">
                        </head><body id="body"><nav><ul class="menu"><li><a href="index.html">Home</a></li>
                        <li><a href="login.html">Login</a></li><li><a href="#">Comprar Ingressos</a></li>
                        <li><a href="#">Historico de Compra</a></li><li><a href="sobreFutIngresso.html">Sobre</a></li>
                        </ul><hr></nav><br><br><br><br><br><center><form id="formLogin" action="recSenha.php" method="POST">
                        <div><cente><a>Senha Atual </a><input type="text" name="senha" id="senha" readonly value="'.$senha.'"><br><br>
                        </cente></div></form></center></body></html>';
                }
                else{
                    echo "<script>alert('a dica não é correspondente, Entre em contato com o adm!');</script>";
                }
            }
            else{
                echo "<script>alert('E-mail não localizado!');</script>";
            }
        }

    }

    $result = enviaSenha($em, $dc);
?>