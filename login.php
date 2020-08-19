<?php
        error_reporting(0);
        //definindo variáveis e recebendo valores
        $Log = $_POST["login"];
        $Sen = $_POST["senha"];
        $result;

        //criando função PHP
        function Login($Login, $Senha){
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
                $sql = ("SELECT * FROM usuarios WHERE email= '".$Login."' AND senha = '".$Senha."'");
                //este código junta a query + a conexão
                $resu = mysql_query($sql,$conexao);
                //recebendo resultados da consulta
                $nome = mysql_result($resu,0,"Nome");
                $email = mysql_result($resu,0,"email");
                $pass = mysql_result($resu,0,"senha");
                $cod = mysql_result($resu,0,"tipoUsuario");
                //if encadeado para verificações das ações que o sistema vai tomar em caso de usuário encontrado\não encontrado
                if($email == $Login){
                    if($pass == $Senha){
                        echo "<script>alert('Bem Vindo!');</script>";
                        if($cod==1){
                            if(session_status() !== PHP_SESSION_ACTIVE){
                                session_start();
                            }
                            $_SESSION['nome_usuario'] = $nome;
                            $_SESSION['login_usuario'] = $email;
                            echo "<script>location.href='cadJogo.html'</script>";  
                        }
                        else{
                            if(session_status() !== PHP_SESSION_ACTIVE){
                                session_start();
                            }
                            $_SESSION['nome_usuario'] = $nome;
                            $_SESSION['login_usuario'] = $email;
                            echo "<script>location.href='ListarJogo.php'</script>";
                        }             
                    }
                    else{
                        echo "<script>alert('Erro: usuário e senha não encontrados');</script>";
                        echo "<script>location.href='Login.html'</script>"; 
                    }
                }else{
                    echo "<script>alert('Erro: usuário e senha não encontrados');</script>";
                    echo "<script>location.href='Login.html'</script>"; 
                }
            }
            //fecha a conexão
            mysql_close($conexao);
        }

        if($Log == ""){
            echo "<script>alert('Erro: Campo Login Vazio');</script>";
            echo "<script>location.href='Login.html'</script>"; 
        }else if($Sen == ""){
            echo "<script>alert('Erro: Campo Senha Vazio');</script>";
            echo "<script>location.href='Login.html'</script>"; 
        }else{
            //variável recbendo o retorno da função
            $result = Login($Log, $Sen);
        }
        
?>