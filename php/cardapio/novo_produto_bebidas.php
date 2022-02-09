<?php
//session_start();
require_once '../conexao.php'; 
include_once 'mensage.php';

$id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM usuarios WHERE usuario_id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($resultado);

if(isset($_POST['salvar'])):
  //$categoria = strtolower(mysqli_escape_string($conexao, $_POST['categoria']));
  $categoria = $_POST['categoria'];
  $nome = mysqli_escape_string($conexao, $_POST['nome']);
  $embalagem = mysqli_escape_string($conexao, $_POST['embalagem']);
  $valor = mysqli_escape_string($conexao, $_POST['valor']);  

    $sql = "INSERT INTO produtos (categoria_fk, nome, embalagem, valor, usuario_id_fk) VALUES ('$categoria', '$nome', '$embalagem', '$valor', '$id')";

    if(empty($categoria) or empty($nome) or empty($embalagem) or empty($valor)):
        $_SESSION['mensagem'] = "Atenção! Todos os campos devem ser preenchidos!";
        header('location: novo_produto_comidas.php'); 
        else:
            if(mysqli_query($conexao, $sql)): 
                $_SESSION['mensagem'] = "Produto Cadastrado!";          
                header('location: novo_produto_bebidas.php?sucesso');
            else:
                $_SESSION['mensagem'] = "Erro! Tente novamente!";
                header('location: novo_produto_bebidas.php?erro');
            endif;
        endif;
    endif;
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Novo Produto / Bebidas</title>
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

<body>

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
                    <li><a href="../sair.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b>Adicionar Novo Produto / Bebidas</h4></b>
            <br>
            <form name="novo_produto_bebidas" action="novo_produto_bebidas.php" method="POST">

                <label>Click para selecionar a categoria do produto</label>
                <select class="browser-default" name="categoria" id="categoria">
                    <option value="" disabled selected>Categorias</option>
                    <option value="cervejas"> Cevejas </option>
                    <option value="refrigerantes">Refrigerantes</option>
                    <option value="sucos">Sucos</option>
                    <option value="drinks">Drinks</option>                    
                </select>


                <div class="input-field col s12">
                    <input type="text" name="nome" id="nome">
                    <label for="nome">Nome do Produto</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="embalagem" id="embalagem">
                    <label for="embalagem">Embalagem</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="valor" id="valor">
                    <label for="valor">Valor</label>
                </div>

                <p align="center">
                    <button type="submit" name="salvar" class="btn green">Salvar Produto</button>
                    <a href="criacao.php" target="_blank" type="submit" class="btn cyan">Visualizar Cardápio</a>
                </p>

            </form>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>