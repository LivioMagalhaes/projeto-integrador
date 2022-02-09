<?php
require_once '../conexao.php';
session_start();

//pegando produtos do usuario id
$id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM usuarios WHERE usuario_id = '$id'";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($resultado);
?>

<!--envio do arquivo de imagem de fundo-->
<?php 
    if(isset($_FILES['arquivo'])){
        $arquivo = $_FILES['arquivo'];    
        $pasta = "arquivos/";                                                   //seleciona a pasta para inserir o arquivo 
        $nomeDoArquivo = $arquivo['name'];                                      //pega o nome do arquivo    
        $novoNomeDoArquivo = uniqid();                                          //cria um nome único para o arquivo
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));   //pega a extensão do arquivo e converte pra minusculo
            
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;  //variável que recebe o novo nome com a extensão e a pasta do novo arquivo
            
        //variável $deu_certo que vai mover o arquivo com nome criado temporário para a pasta /arquivos
        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);                          
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Edição do Cardápio</title>
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
            <h4 class="light" style="text-align: center;"><b>Editar / Excluir Produtos</h4></b>
            <table class="striped">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Produto</th>
                        <th>Ingredientes</th>
                        <th>Embalagem</th>
                        <th>Valor</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $id = $_SESSION['usuario_id'];
                        $sql = "SELECT * FROM produtos WHERE usuario_id_fk = '$id'";
                        $resultado = mysqli_query($conexao,$sql);
                        while($dados = mysqli_fetch_array($resultado)):
                    ?>
                    <tr>
                        <td><?php echo $dados['categoria_fk']; ?></td>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['ingredientes']; ?></td>
                        <td><?php echo $dados['embalagem']; ?></td>
                        <td><?php echo $dados['valor']; ?></td>

                        <!--botões editar/excluir-->
                        <td><a href="edicao.php?produtos_id=<?php echo $dados['produtos_id']; ?>"
                                class="btn-floating orange"><i class="material-icons">edit</i></td>
                        <td><a href="#modal<?php echo $dados['produtos_id']; ?>"
                                class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

                        <!-- Modal Structure caixa de messagem de alerta-->
                        <div id="modal<?php echo $dados['produtos_id']; ?>" class="modal">

                            <div class="modal-content">
                                <h3 align="center">Atencão!!!</h3>
                                <h4 align="center">Tem certeza que dejesa excluir este produto?</h4>
                                <h5>Categoia: <?php echo $dados['categoria_fk'];?>
                                    <br>Produto : <?php echo $dados['nome']; ?>
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <form action="excluir.php" method="POST">
                                    <input type="hidden" name="produtos_id"
                                        value="<?php echo $dados['produtos_id']; ?>">
                                    <button type="submit" name="excluir" class="btn red">Excluir</button>
                                    <a href="#!" class="modal-close btn green">Cancelar</a>
                                </form>
                            </div>
                        </div>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
            <br>
            <p align="center">
            <a href="novo_produto_comidas.php" target="_blank" type="submit" class="btn green">Adiconar Comidas</a>
            <a href="novo_produto_bebidas.php" target="_blank" type="submit" class="btn green">Adiconar Bebidas</a>            
            <a href="cardapio.php" class="btn cyan" target="_blank">Visualizar Cardápio</a>
            </p>
        </div>
    </div>

    <!--formulário para inserir imagem de fundo a visualizar-->
    <form method="POST" enctype="multipart/form-data" action="">
        <hr>
        <p><label for=""><h4 align="center"> Aqui você pode selecionar um arquivo de imagem para o cardápio <br> (formato A4 com resulução de 2480px por 3508px e tamanho máximo de 5mb</h4></label>
        <h5 align="center">
            <input name="arquivo" type="file">
            <button name="upload" type="submit"> Selecionar arquivo </button>
        </h5>
        </p>                       
        <hr>

        <?php
        //mensagem quando for enviado o arquivo de imagem e inserido no banco
        if(!empty($deu_certo)){
                //insere o caminho do arquivo na tabela arquivos na coluna path
                $sql = "INSERT INTO arquivos(nome, path) VALUES('$nomeDoArquivo', '$path')";
                $insereNoBanco = mysqli_query($conexao, $sql);            
                echo "<p align='center'>Arquivo [".$nomeDoArquivo."] enviado com sucesso! <br> Para visualizar o arquivo, <a target=\"_blank\" href=\"arquivos/$novoNomeDoArquivo.$extensao\"> clique aqui. </a>";
            } 
        ?>
    </form>
    <hr>

    <!--scrpit para inicializar a janela Modal-->
    <script>
        M.AutoInit();
    </script>
    
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>