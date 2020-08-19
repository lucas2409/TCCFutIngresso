<?php
    session_start();
    error_reporting(0);
    $resul;

    function pesqUser(){
        //estabilizando conexão com servidor
        $conexao = mysql_connect("localhost" , "root" , "root" ) or die ("Erro ao conectar"); 
        //verificando mais algum erro e redirecionando para o Login novamente
        if(!$conexao){
            echo "<script>alert('Erro ao conectar! contate o adm.');</script>";
            echo "<script>location.href='login.html'</script>";               
        }
        //em caso de não houver erro irá seguir para validação de usuário
        else{
            $emailusuario = $_POST['email'];
            if($emailusuario == ''){
                //conectando com o respectivo banco do servidor
                mysql_select_db("futingresso", $conexao);
                //query de consulta
                $sql = ("SELECT * FROM usuarios ");
                $resultado = mysql_query($sql, $conexao);
                if($resultado){
                    echo "<html><head><meta charset='UTF-8'><title>FutIngresso - Seu ingresso rápido e facil
                    </title><link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                    <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                    <link href='css/tabela.css' rel='stylesheet'></head><body id='body'><nav><ul class='menu'>
                    <li><a href='index.html'>Home</a></li><li><a href='cadJogo.html'>Cadastrar Jogo</a></li>
                    <li><a href='altjogo.php'>Alterar jogos</a></li><li><a href='altUser.php'>Alterar Usuarios</a></li>
                    <li><a href='PainelVendas.php'>Vendas</a></li></ul><hr></nav><br><br><br><br><br>
                    <form action='altUser.php' method='POST'><table class='tabe' align='center'><tr><td>Pesquisar E-mail:<input type='text' name='email' id='email'>
                    </td><td class='td'><br><button type='submit' class='botao botao-btn-info' onclick='' >Pesquisar</button><br><br>
                    </td></tr></table></form>";
                    while($pesq=mysql_fetch_array($resultado)){
                        $cod = $pesq['codigoUsuario'];
                        $nome = $pesq['Nome'];
                        $email = $pesq['email'];
                        $senha = $pesq['senha'];
                        $dica = $pesq['Dicasenha'];
                        $cadativo = $pesq['cadastroAtivo'];
                        $tipo = $pesq['tipoUsuario'];

                        if($cadativo==1){
                            $cadativo = 'Sim';
                        }
                        else{
                            $cadativo = 'Não';
                        }
                        if($tipo==1){
                            $tipo = 'Administrativo';
                        }
                        else{
                            $tipo = 'Cliente';
                        }

                        echo "<form action='confaltuser.php' method='POST'>
                        <table class='tabe' align='center'>
                        <th align='center'> Codigo </th>
                        <th align='center'> Nome </th>
                        <th align='center'> E-mail </th>
                        <th align='center'> Dica de Senha </th>
                        <th align='center'> Cadastro Ativo </th>
                        <th align='center'> Tipo Usuario </th>
                        <tr align='center'>
                        <td class='td'><input type='text' readonly name='cod' id='cod' value='".$cod."'></td>
                        <td class='td'><input type='text' readonly name='Nome' id='Nome' value='".$nome."'></td>
                        <td class='td'><input type='text' readonly name='email' id='email' value='".$email."'></td>
                        <td class='td'><input type='text' readonly name='dica' id='dica' value='".$dica."'></td>
                        <td class='td'><input type='text' readonly name='cadativo' id='cadativo' value='".$cadativo."'></td>
                        <td class='td'><input type='text' readonly name='tipo' id='tipo' value='".$tipo."'></td>
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
                        <div><cente><b><a>Não existem usuarios cadastrados!</a></b><b><a></a></b>
                        </cente></div></form></center></body></html>";
                }
            }
            else{
                //conectando com o respectivo banco do servidor
                mysql_select_db("futingresso", $conexao);
                //query de consulta
                $sql = ("SELECT * FROM usuarios WHERE email='".$emailusuario."'");
                $resultado = mysql_query($sql, $conexao);
                if($resultado){
                    echo "<html><head><meta charset='UTF-8'><title>FutIngresso - Seu ingresso rápido e facil
                    </title><link href='css/menu.css' rel='stylesheet'><link href='css/camposdeTexto.css' rel='stylesheet'>
                        <link href='css/botoes.css' rel='stylesheet'><link href='css/forms.css' rel='stylesheet'>
                        <link href='css/tabela.css' rel='stylesheet'></head><body id='body'><nav><ul class='menu'>
                        <li><a href='index.html'>Home</a></li><li><a href='cadJogo.html'>Cadastrar Jogo</a></li>
                        <li><a href='altjogo.php'>Alterar jogos</a></li><li><a href='altUser.php'>Alterar Usuarios</a></li>
                        <li><a href='#'>Vendas</a></li></ul><hr></nav><br><br><br><br><br>
                        <form action='altUser.php' method='POST'><table class='tabe' align='center'><tr><td>Pesquisar E-mail:<input type='text' name='email' id='email'>
                        </td><td class='td'><br><button type='submit' class='botao botao-btn-info' onclick='' >Pesquisar</button><br><br>
                        </td></tr></table></form>";
                        while($pesq=mysql_fetch_array($resultado)){
                            $cod = $pesq['codigoUsuario'];
                            $nome = $pesq['Nome'];
                            $email = $pesq['email'];
                            $senha = $pesq['senha'];
                            $dica = $pesq['Dicasenha'];
                            $cadativo = $pesq['cadastroAtivo'];
                            $tipo = $pesq['tipoUsuario'];

                            if($cadativo==1){
                                $cadativo = 'Sim';
                            }
                            else{
                                $cadativo = 'Não';
                            }
                            if($tipo==1){
                                $tipo = 'Administrativo';
                            }
                            else{
                                $tipo = 'Cliente';
                            }
    
                            echo "<form action='confaltuser.php' method='POST'>
                            <table class='tabe' align='center'>
                            <th align='center'> Codigo </th>
                            <th align='center'> Nome </th>
                            <th align='center'> E-mail </th>
                            <th align='center'> Dica de Senha </th>
                            <th align='center'> Cadastro Ativo </th>
                            <th align='center'> Tipo Usuario </th>
                            <tr align='center'>
                            <td class='td'><input type='text' readonly name='cod' id='cod' value='".$cod."'></td>
                            <td class='td'><input type='text' readonly name='Nome' id='Nome' value='".$nome."'></td>
                            <td class='td'><input type='text' readonly name='email' id='email' value='".$email."'></td>
                            <td class='td'><input type='text' readonly name='dica' id='dica' value='".$dica."'></td>
                            <td class='td'><input type='text' readonly name='cadativo' id='cadativo' value='".$cadativo."'></td>
                            <td class='td'><input type='text' readonly name='tipo' id='tipo' value='".$tipo."'></td>
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
                        <div><cente><b><a>Não existem usuarios cadastrados!</a></b><b><a></a></b>
                        </cente></div></form></center></body></html>";
                }     
            }
        }
    }
    $resul = pesqUser();
?>