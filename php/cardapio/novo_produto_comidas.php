<?php
//session_start();
require_once '../conexao.php'; 
include_once 'mensage.php';

$id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM usuarios WHERE usuario_id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($resultado);

if(isset($_POST['salvar'])):
    $categoria = $_POST['categoria'];    
    $nome = mysqli_escape_string($conexao, $_POST['nome']);
    $ingredientes = mysqli_escape_string($conexao, $_POST['ingredientes']);
    $valor = mysqli_escape_string($conexao, $_POST['valor']);  

    $sql = "INSERT INTO produtos (categoria_fk, nome, ingredientes, valor, usuario_id_fk) VALUES ('$categoria', '$nome', '$ingredientes', '$valor', '$id')";
    
    if(empty($categoria) or empty($nome) or empty($ingredientes) or empty($valor)):
        $_SESSION['mensagem'] = "Atenção! Todos os campos devem ser preenchidos!";
        header('location: novo_produto_comidas.php');
        else:
            if(mysqli_query($conexao, $sql)):
                $_SESSION['mensagem'] = "Cadastrando produto!";
                header('location: novo_produto_comidas.php');
            else:
                $_SESSION['mensagem'] = "Erro! Tente novamente!";
                header('location: novo_produto_comidas.php');
            endif;
        endif; 
    endif;
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Novo Produto / Comidas</title>
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
            <h4 class="light" style="text-align: center;"><b>Adicionar Novo Produto / Comidas</h4></b>
            <br>
            <form action="novo_produto_comidas.php" method="POST">
            
                <label>Click para selecionar a categoria do produto</label>
                <select class="browser-default" name="categoria" id="categoria">
                    <option value="" disabled selected>Categorias</option>
                    <option value="bolos"> Bolos </option>
                    <option value="doces">Doces</option>
                    <option value="especiais">Especiais</option>
                    <option value="hamburguers">Hamburguer</option>
                    <option value="pizzas">Pizzas</option>
                    <option value="salgados">Salgados</option>                    
                    <option value="tortas">Tortas</option>
                </select>

                <div class="input-field col s12">
                    <input type="text" name="nome" id="nome">
                    <label for="nome">Nome do Produto</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="ingredientes" id="ingredientes">
                    <label for="ingredientes">Ingredientes</label>
                </div>

                <div class="input-field col s12">
                    <input type="text" name="valor" id="valor">
                    <label for="valor">Valor</label>
                </div>

                <!--botões salvar e visualizar-->
                <p align="center">
                    <!-- usado com a funcaoClicar() <button type="submit" name="salvar" class="btn" onclick="funcaoClicar()">Salvar</button>-->
                    <button type="submit" name="salvar" class="btn green"> Salvar Produto </button>
                    <a href="criacao.php" target="_blank" type="submit" class="btn cyan">Visualizar Cardápio</a>                    
                </p>
            </form>
        </div>
    </div>

    <!-- Modal Structure janela de alerta de exluir produto-->
    <div id="modal<?php echo $dados['nome']; ?>" class="modal">
        <div class="modal-content">
            <h4>Atencão</h4>
            <p>Tem certeza que dejesa excluir este produto?</p>
            <?php echo $dados['nome'];?>
        </div>

        <div class="modal-footer">
            <form action="novo_produto_comidas.php" method="POST">

                <button type="submit" name="salvar" class="btn red">Sim, deletar!</button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            </form>
        </div>
    </div>

    <!--JavaScript at end of body for optimized loading - otimizar a página onload-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>