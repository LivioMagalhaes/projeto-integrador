<?php
require_once '../conexao.php';
session_start();
$id = $_SESSION['usuario_id'];

//pegar a imagem na pasta php/cardapio/arquivos
$sql = "SELECT * FROM arquivos";
$resultado = mysqli_query($conexao, $sql);
$imagem = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
    body {
        background-image: url('<?php echo $imagem['path']; ?>');
        /*background-repeat: repeat;*/
        /*background-attachment: scroll;*/        
        background-size: contain;
        border: 6px solid darkgray;
        
    }

    thead {
        background-color: LightCyan;
    }
    </style>
</head>

<body>
  <!--usar este espaço para a logo do cliente-->
  <br><br><br><br><br><br><br><br><br><br><br><br><br>    

    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b> Pizzas </h4></b>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Ingredientes</th>
                        <th>Valor</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
            $sql = "SELECT * FROM produtos WHERE categoria_fk = 'pizzas'";
            $resultado = mysqli_query($conexao, $sql);
            while($dados = mysqli_fetch_array($resultado)):
          ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['ingredientes']; ?></td>
                        <td><?php echo $dados['valor']; ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b> Salgados </h4></b>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Ingredientes</th>
                        <th>Valor</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
            $sql = "SELECT * FROM produtos WHERE categoria_fk = 'salgados'";
            $resultado = mysqli_query($conexao,$sql);
            while($dados = mysqli_fetch_array($resultado)):
          ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['ingredientes']; ?></td>
                        <td><?php echo $dados['valor']; ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b> Bolos </h4></b>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Ingredientes</th>
                        <th>Valor</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
            $sql = "SELECT * FROM produtos WHERE categoria_fk = 'bolos'";
            $resultado = mysqli_query($conexao,$sql);
            while($dados = mysqli_fetch_array($resultado)):
          ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['ingredientes']; ?></td>
                        <td><?php echo $dados['valor']; ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div><br><br><br>

    <div class="row">
        <div class="col s12 m6 push-m3">
        <hr>
            <h3 align="center"><b>Bebidas</h3></b>
        <hr>
        </div>
    </div><br><br>

    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b> Refrigerantes </h4></b>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Embalagem</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            $sql = "SELECT * FROM produtos WHERE categoria_fk = 'refrigerantes'";
            $resultado = mysqli_query($conexao,$sql);
            while($dados = mysqli_fetch_array($resultado)):
        ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['embalagem']; ?></td>
                        <td><?php echo $dados['valor']; ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b> Cerjevas </h4></b>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Embalagem</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            $sql = "SELECT * FROM produtos WHERE categoria_fk = 'cervejas'";
            $resultado = mysqli_query($conexao,$sql);
            while($dados = mysqli_fetch_array($resultado)):
        ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['embalagem']; ?></td>
                        <td><?php echo $dados['valor']; ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b> Drinks </h4></b>
            <table class="highlight">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Embalagem</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            $sql = "SELECT * FROM produtos WHERE categoria_fk = 'drinks'";
            $resultado = mysqli_query($conexao,$sql);
            while($dados = mysqli_fetch_array($resultado)):
        ?>
                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['embalagem']; ?></td>
                        <td><?php echo $dados['valor']; ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>       
    </div>



    <div class="row" align="center">
        <div class="col s12 m6 push-m3">
            <h4 class="light" style="text-align: center;"><b> Click para gerar seu QrCode desta página </h4></b>
            
            <img src="../img/qrcode.png" style="width: 150px; height: 150px;"></a>
            <br><br>
            <a href="https://www.qrplus.com.br/" target="_blank" type="submit" class="btn black">Gerar QR Code</a>
        </div>       
    </div>
    
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>