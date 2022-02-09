<?php
require_once '../conexao.php';
session_start();

//pegar o produto pelo id
if(isset($_GET['produtos_id'])):
    $id = mysqli_escape_string($conexao, $_GET['produtos_id']);
    $sql = "SELECT * FROM produtos WHERE produtos_id = '$id'";
    $resultado = mysqli_query($conexao,$sql);
    $dados = mysqli_fetch_array($resultado);
endif;

if(isset($_POST['salvar'])):    
    $categoria_fk = mysqli_escape_string($conexao, $_POST['categoria_fk']);
    $nome = mysqli_escape_string($conexao, $_POST['produto']);
    $ingredientes = mysqli_escape_string($conexao, $_POST['ingredientes']);
    $embalagem = mysqli_escape_string($conexao, $_POST['embalagem']);
    $valor = mysqli_escape_string($conexao, $_POST['valor']);
    $produtos_id = mysqli_escape_string($conexao, $_POST['produtos_id']);
      
    $sql = "UPDATE produtos SET categoria_fk = '$categoria_fk', nome = '$nome', ingredientes = '$ingredientes', embalagem = '$embalagem',  valor = '$valor' WHERE produtos_id = '$produtos_id'";
      
        if(mysqli_query($conexao,$sql)):
            header('location: criacao.php?Atualizado comsucesso');
            else:
            header('location: criacao.php?erro ao atualizar');
        endif; 
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Editar Produto</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <img src="../img/LogoCadapioDigital.png" style="width: 60px; height: 60px; position: relative; top: 0px;">
                <a href="#" class="brand-logo">
                    <!--<h5><b>Bem vindo, <?php echo $dados['nome']; ?></h5></b>-->
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="cardapio/cardapio.php" target="_blank">Visualiar Cardápio</a></li>
                    <li><a href="cardapio/criacao.php" target="_blank">Editar Cardápio</a></li>
                    <li><a href="../sair.php">Sair</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b>Editar Produto</h4></b>
            <br>
            <form action="edicao.php" method="POST">                
                <input type="hidden" name="produtos_id" value="<?php echo $dados['produtos_id']; ?>">
                
                <div class="input-field col s12">
                    <input type="text" name="categoria_fk" id="categoria_fk" value="<?php echo $dados['categoria_fk']; ?>">
                    <label for="categoria_fk">Categoria</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="produto" id="produto" value="<?php echo $dados['nome']; ?>">
                    <label for="produto">Produto</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="ingredientes" id="ingredientes"
                        value="<?php echo $dados['ingredientes']; ?>">
                    <label for="ingredientes">Ingredientes (não preencher, se não souber)</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="embalagem" id="embalagem"
                        value="<?php echo $dados['embalagem']; ?>">
                    <label for="embalagem">Embalagem (não preencher, se não souber)</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="valor" id="valor" value="<?php echo $dados['valor']; ?>">
                    <label for="valor">Valor</label>
                </div>
                <p align="center">
                    <button type="submit" name="salvar" class="btn green">Salvar</button>
                    <a href="criacao.php" type="submit" class="btn cyan">Voltar</a>
                </p>
            </form>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>