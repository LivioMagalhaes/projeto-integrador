<?php

    //conexão com o banco de dados
    require_once 'conexao.php';

    // pegando o click do botao cadastrar
    if(isset($_POST['submit'])):
        
        $erros = array();
        $nome = mysqli_escape_string($conexao, $_POST['nome']);
        $endereco = mysqli_escape_string($conexao, $_POST['endereco']);
        $bairro = mysqli_escape_string($conexao, $_POST['bairro']);
        $estado = mysqli_escape_string($conexao, $_POST['estado']);
        $contato = mysqli_escape_string($conexao, $_POST['contato']);
        $email = mysqli_escape_string($conexao, $_POST['email']);
        $senha = mysqli_escape_string($conexao, $_POST['senha']);
        $senha = md5($senha);
        echo $senha;

        // Verificando se os campos estão vazios
        if(empty($nome) or empty($endereco) or empty($bairro) or empty($estado) or empty($contato) or empty($email) or empty($senha)):
            $erros[] = "<li> Todos os campos precisam ser preenchidos </li><br>";

            // Verificando o tamanho da senha
            //elseif(strlen($senha) < 3 or strlen($senha) > 32):
                //$erros[] = "<li> A senha precisa ter entre 3 e 8 caracteres </li><br>";

                // verificando se o email passado ja está cadastrado no banco de dados
                else:
                    $sql = "SELECT email FROM usuarios WHERE email = '$email'";
                    $resultado = mysqli_query($conexao, $sql);

                    if(mysqli_num_rows($resultado) > 0):
                        $erros[] = "<li> E-mail já cadastrado </li><br>";
                
                        else:
                        $result = "INSERT INTO usuarios(nome,endereco,bairro,estado,contato,email,senha) VALUES ('$nome','$endereco','$bairro','$estado','$contato','$email','$senha')";
            
                        if(mysqli_query($conexao, $result)):
                            header("location: Login.php?sucesso");
                
                            else:
                            header("location: Cadastro.php?erro");
                        endif;
                    endif;        
                endif;
            endif;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Cadastro</title>

    <style>
        li{
            color: white;
        }
    </style>
   
</head>
<body style="background-color: #C0C0C0;;">
    <form action="Cadastro.php" method="POST">
        <div style="background-color: #4F4F4F; position: absolute; top: 50%;left: 50%; transform: translate(-50%,-50%);padding: 40px;border-radius: 15px;">
            <h1 style="text-decoration: underline; color: white; text-align: center;">Realizar Cadastro</h1>

            <!-- mostrando os erros na tela -->
            <?php
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
            ?>

            <input type="text" name="nome" placeholder="Nome da Empresa" style="width: 350px;height:30px;"><br><br>
            <input type="text" name="endereco" placeholder="Endereço" style="width: 350px;height:30px;"><br><br>
            <input type="text" name="bairro" placeholder="Bairro" style="width: 350px;height:30px;"><br><br>
            <input type="text" name="estado" placeholder="Estado" style="width: 350px;height:30px;"><br><br>
            <input type="text" name="contato" placeholder="Contato" style="width: 350px;height:30px;"><br><br>
            <input type="email" name="email" placeholder="E-mail" style="width: 350px;height:30px;"><br><br>
            <input type="password" name="senha" placeholder="Senha" style="width: 350px;height:30px;"><br><br>
            <input type="submit" name="submit" value="Cadastrar" style="position: relative; left: 34%; width: 110px;height: 45px;background-color: #2E8B57;color: white; font-size: 18px;">    
        </div>
    </form>
</body>
</html>