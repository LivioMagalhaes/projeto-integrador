<?php
    //conexão com o bando de dados
    require_once "conexao.php";

    //iniciando sessão
    session_start();

    //botao login
    if(isset($_POST['submit'])):
        $erros = array();
        $email = mysqli_escape_string($conexao, $_POST['email']);
        $senha = mysqli_escape_string($conexao, $_POST['senha']);
        $senha = md5($senha);

        // verificando se os campos estao vazios
        if(empty($email) or empty($senha)):
            $erros[] = "<li> Todos os campos precisam ser preenchidos </li><br>";
        else:
            // verificando se o email passado já está no banco de dados
            $sql = "SELECT email FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($conexao, $sql);

            if(mysqli_num_rows($resultado) > 0):

                // verificando se a email e senha do formulario estão no banco de dados
                $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
                $resultado = mysqli_query($conexao, $sql);

                    if(mysqli_num_rows($resultado) == 1):
                        $dados = mysqli_fetch_array($resultado);
                        mysqli_close($conexao);
                        $_SESSION['logado'] = true;
                        $_SESSION['usuario_id'] = $dados['usuario_id'];
                        header("location: Tela_do_Usuario.php");

                    else:
                        $erros[] = "<li> E-mail e senha não conferem </li><br>";
                    endif;

            else:
                $erros[] = "<li> Usuário inexistente </li><br>";
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
    <title>Login</title>

    <style>
    li {
        color: white;
    }
    </style>

</head>

<body style="background-color: #C0C0C0;">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div
            style="background-color: #4F4F4F; position: absolute; top: 50%;left: 50%; transform: translate(-50%,-50%);padding:40px; border-radius: 15px;">
            <h1 style="text-decoration: underline; color: white; text-align: center;">Login</h1><br>

            <!-- mostrando os erros na tela -->
            <?php
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
            ?>

            <p style="color: white; font-size: 18px;top: 50px;margin: 1px;">E-mail</p>
            <input type="email" name="email" style="width: 350px;height:30px;"><br><br>
            <p style="color: white; font-size: 18px;margin: 1px;">Senha</p>
            <input type="password" name="senha" style="width: 350px;height:30px;">
            <p style="color: white;">Ainda não tem cadastro? <a href="Cadastro.php"
                    style="color:#00FF7F;">Cadastre-se</a></p><br>
            <input type="submit" name="submit" value="Login"
                style="position: relative;left: 40%; width: 80px; height: 40px;background-color:#2E8B57; color: white;font-size: 18px;">
        </div>
    </form>

</body>

</html>