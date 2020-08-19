<?php
    session_start();
    $result;
    $cod = $_POST["cod"];
    $_SESSION['codigo'] = $cod; 
    function altuser($codigo){
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
            $sql = ("SELECT * FROM usuarios WHERE codigoUsuario = ".$codigo."");
            $resultado = mysql_query($sql,$conexao);
            if($resultado){
                $codi = mysql_result($resultado,0,"codigoUsuario");
                $nome = mysql_result($resultado,0,"Nome");
                $email = mysql_result($resultado,0,"email");
                $senha = mysql_result($resultado,0,"senha");
                $dica = mysql_result($resultado,0,"Dicasenha");
                $cadAtivo = mysql_result($resultado,0,"cadastroAtivo");
                $tipo = mysql_result($resultado,0,"tipoUsuario");
                echo "<html><head><meta charset='UTF-8'><title>
                FutIngresso - Seu ingresso rápido e facil</title>       
                <link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                </head><body id='body'><nav><ul class='menu'><li><a href='index.html'>Home</a></li>
                <li><a href='cadJogo.html'>Cadastrar Jogo</a></li><li><a href='altjogo.php'>Alterar Jogos</a></li>
                <li><a href='altUser.php'>Alterar Usuários</a></li><li><a href='PainelVendas.php'>Vendas</a></li></ul><hr>
                </nav><br><br><br><br><br><center><form id='formVendas' method='POST' action='updateUser.php'>
                <div><table><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Nome</a>
                <input type='text' name='nome' id='nome' value='".$nome."'></td><br><br><td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a>E-mail</a><input type='text' name='email' id='email' value='".$email."'></td><td>&nbsp;&nbsp;&nbsp;
                </td></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr><td>&nbsp;<a>Dica de Senha</a>
                <input type='text' name='dica' id='dica' value='".$dica."'></td>";
                    if($cadAtivo == 1){
                       echo "<td>Cadastro Ativo <select name='cadativo' id='cadativo'><option value='Sim'>Sim</option><option value='Não'>Não</option></select>";
                    }   
                    else
                    {
                        echo "<td>Cadastro Ativo <select name='cadativo' id='cadativo'><option value='Não'>Não</option><option value='Sim'>Sim</option></select>";
                    } 
                    if($tipo == 1){
                        echo "<td>Tipo Usuario<select name='tipo' id='tipo'><option value='Administrativo'>Administrativo</option><option value='Cliente'>Cliente</option></select>";
                     }   
                     else
                     {
                         echo "<td>Cadastro Ativo<select name='tipo' id='tipo'><option value='Cliente'>Cliente</option><option value='Administrativo'>Administrativo</option></select>";
                     }         
                echo "</td>   
                </tr></table><br><br><button type='submit' class='botao botao-btn-info' >Alterar</button>&nbsp;
                </div></form><button type='submit' class='botao botao-btn-canc' onclick=location.href='altUser.php'>Voltar</button>";
            }
            else{
                echo "<script>alert('Usuário não localizado')</script>";
                echo "<script>location.href='cadJogo.html'</script>";
            }
        }
    }

    $result = altuser($cod);
?>