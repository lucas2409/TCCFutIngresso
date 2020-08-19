<?php
    $result;
    $nm = $_POST["login"];
    $em = $_POST["email"];
    $sn = $_POST["senha"];
    $dc = $_POST["dica"];

    Function cadLogin($email, $senha, $nome, $dica){
        $cadastro = 1;
        $tipo = 2;
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
            //query para consulta 
            $sql = ("SELECT * FROM usuarios WHERE email= '".$email."'");
            //este código junta a query + a conexão
            $resu = mysql_query($sql,$conexao);
            //recebendo resultados da consulta
            $login = mysql_result($resu,0,"email");
            //validando login, em caso de e-mail já cadastrado não irá fazer o cadastro
            if ($login ==  $email)
            {
                //manda mensagem e redireciona para a tela de Login
                echo "<script>alert('E-mail Já cadastrado! Por favor faça o Login!');</script>";
                echo "<script>location.href='login.html'</script>";
            }
            else{
                //query de inserção
                $sql = ("INSERT INTO usuarios (Nome, email, senha, DicaSenha, CadastraoAtivo, \n
                tipoUsuario)VALUES('".$nome."','".$email."','".$senha."','".$dica."',".$cadastro.",".$tipo.")");
                //valida se a query está valida e efetua o redirecionamento.
                if(mysql_query($sql, $conexao)){
                    echo "<script>alert('Usuario Cadastrado! Por favor faça o Login!');</script>";
                    echo "<script>location.href='login.html'</script>";
                }
                else{
                    echo "<script>alert('Erro ao cadastrar! Por favor contate o adm!');</script>";
                    echo "<script>location.href='cadLogin.html'</script>";
                }
            }
            mysql_close($conexao);
        }    
    }
    $result = CadLogin($em,$sn,$nm,$dc);
?>