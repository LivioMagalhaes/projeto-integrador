<?php
//conexao
require_once "conexao.php";

//inicindo sessão
session_start();

//verificando se o usuario esta logado
if(!isset($_SESSION['logado'])):
    header("location: login.php");
endif;

/// pegando todos os dados do usuario
$id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM usuarios WHERE usuario_id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela do Usuario</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/res.css" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
</head>

<body style="background-color:#C0C0C0;">

    <!---------------------------- navbar ------------------------------>
    <div class="navbar-scroll">
        <nav>
            <div class="nav-wrapper">
                <img src="../img/LogoCadapioDigital.png" style="width: 60px; height: 60px; position: relative; top: 0px;">
                <a href="#" class="brand-logo">
                    <h5><b>Bem vindo de volta, <?php echo $dados['nome']; ?></h5></b>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">                   
                    <li><a href="cardapio/cardapio.php" target="_blank" >Visualizar Cardápio</a></li>
                    <li><a href="cardapio/criacao.php" target="_blank" >Editar Cardápio</a></li>
                    <li><a href="sair.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>
    
    <!-------------------------------------------------------------------->

    <div class="row">
        
        <div class="col-md-6" align="center" id="res">
            <h4>Aqui você pode editar seu cardápio, <br> adicionar ou excluir produtos</h4>
            <h3 class="text-center" font style="vertical-align: inherit;">Seu Cardápio</h3>
            <br>
            <img src="img/cardapio_01.jpg" style="width: 250px; height: 250px;">
            <br><br>
            <a href="cardapio/novo_produto_comidas.php" target="_blank" type="submit" class="btn green">Adiconar Comidas</a>
            <a href="cardapio/novo_produto_bebidas.php" target="_blank" type="submit" class="btn green">Adiconar Bebidas</a>
            <br><br>
            <a href="cardapio/cardapio.php" target="_blank" type="submit" class="btn cyan" color="black">Gerar Cardápio</a>
            <a href="cardapio/criacao.php" target="_blank" type="submit" class="btn cyan">Editar Produtos</a>
        </div>

        <div class="col-md-6" align="center" id="res">
            <h4>Aqui você tem o link para gerar o QrCode <br> de sua página com o cardápio criado</h4>
            <h3 class="text-center" font style="vertical-align: inherit;">Seu QR Code</h3>
            <br>
            <img src="img/qrcode.png" style="width: 250px; height: 250px;"></a>
            <br><br>
            <a href="cardapio/cardapio.php" target="_blank" type="submit" class="btn black">Visualizar e gerar QrCode do cardápio</a>
        </div>        
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>