<?php
    ob_start();
    session_start();
    include "../controladora/conexao.php";
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Define o conjunto de caracteres usado no documento, aqui é UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define a escala inicial e a largura da viewport para uma visualização responsiva em dispositivos móveis -->
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- Link para a pasta e o arquivo de estilos CSS que define a aparência do documento -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Sua Medida - Ateliê de costura</title>
    <!-- Define o título da página, que aparece na aba do navegador -->

    
</head>



<header>
    <div id="area_cabecalho"><!--cabecalho -->
        <div id="area_logo"><!-- logo-->
            <h1 id="cor_logo">Sua<span style="color: #8C8C8C;">Medida</span></h1>
        </div>
        <!-- Cabeçalho do site -->
<nav>
            <!-- Seção de navegação -->
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#section1">Roupas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section2">Sobre nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section3">Cadastre-se</a>
      
              </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section4">Logue-se</a>
                </li>
            </ul>
        </div>
        </nav>
</header>

<!--seção de navegação das paginas-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"></nav>

<div id="section1" class="container-fluid bg-success text-white" style="padding:100px 20px;">
    
  <h1>Roupas</h1>
  <section id="home" class="home">
   <ul>
        <?php
            include "../controladora/ProdutoRepositorio.php";
            $produtoRepositorio = new ProdutoRepositorio($conn);
            $itens = $produtoRepositorio->listarProdutos();

            foreach ($itens as $item):
                   
                ?>
            <li>
                <!-- Outro item da lista com imagem e descrição -->
                <img src="<?=$item->imagem?>"/>
                <!-- Imagem do item, com texto alternativo para acessibilidade -->
                <div class="home-descricao">
                    <!-- Div para a descrição do item -->
                    <p><?=$item->nome?></p>
                    <!-- Nome do item -->
                    <p>TAM: M</p>
                    <!-- Tamanho do item -->
                    <p><?=$item->preco?></p>
                    <!-- Preço do item -->
                    <a href="?adicionar=<?=$item->id?>">Adicionar ao carrinho</a>

                </div>
            </li>       
                <?php
            
        ?>
        <?php
        endforeach
        ?>
                <?php
                //adicionando ao carrinho
                if(isset($_GET['adicionar'])){
                 $idProduto = (int) $_GET['adicionar'];
                 if(isset($itens[$idProduto])){
                    if (isset($_SESSION['carrinho'][$idProduto])){
                        $_SESSION ['carrinho'][$idProduto]['quantidade']++;
                    }else{
                        $_SESSION['carrinho'][$idProduto] = array ('quantidade' => 1, 'nome' => $itens[$idProduto]->nome,
                        'preco' => $itens[$idProduto]->preco);
                    }
                    echo '<script>alert("O item foi adicionado ao seu carrinho de compras.");</script>';
                 }       
                }
                ?>

        </ul>
        <div class="carrinho">
            <div class="ti-carrinho">
                <h2>Nova compra</h2>
                <p>
                <?php
                    //quantidade de itens no carrinho
                    $qtd_itens = 0;
                        foreach ($_SESSION['carrinho'] as $key => $value){
                            $qtd_itens += $value['quantidade'];
                        }
                        echo $qtd_itens;
                        ?>
                        itens no carrinho
                </p>
            </div>
            <div class="produtos">
                <?php
                //listando os itens adicionados
                if (isset($_SESSION['carrinho'])) {
                    foreach ($_SESSION['carrinho'] as $key => $value) {
                        ?>
                        <div class="itens">
                            <a href="?remove=<?php echo $key ?>"><img src="imagens/lixo.png" alt="remover"></a>
                            <div class="nome_preco">
                                <h2><?php echo $value['nome'] ?></h2>
                                <?php $preco = $value['preco'] * $value['quantidade']; ?>
                                <p>R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                            </div>
                            <span><?php echo $value['quantidade'] ?></span>
                            <hr>
                        </div>
                        <?php
                    }
                }
                    ?>

        <?php
        //remover do carrinho
        if (isset($_GET['remove'])) {
            $idProduto = (int)$_GET['remove'];
            if (isset($_SESSION['carrinho'][$idProduto])) {
                unset($_SESSION['carrinho'][$idProduto]);
                echo '<script>alert("O item foi removido do seu carrinho de compras.");</script>';
            }
        }


        //esvaziar carrinho
        if (isset($_GET['finalizar'])) {
            unset($_SESSION['carrinho']);
        }
        ?>
    </div>

        </div>

        <div class="total">
            <h2>Subtotal <p>R$
            <?php
            //subtotal da compra
            $sub = 0;
                if (isset($_SESSION['carrinho'])) {
                    foreach ($_SESSION['carrinho'] as $value) {
                        $sub += $value['preco'] * $value['quantidade'];
                    }
                }
                echo number_format($sub, 2, ',', '.');
                ?>
            </span></h2>

            <h2>Total <span>
                <?php
                // Total da compra
                $total = 0;
                if (isset($_SESSION['carrinho'])) {
                    foreach ($_SESSION['carrinho'] as $value) {
                        $total += $value['preco'] * $value['quantidade'];
                    }
                }
                echo number_format($total, 2, ',', '.');
                ?>
            </span></h2>
            <a href="?finalizar=1"><button>Finalizar</button></a>
        </div>

    </section> 
</div>

<div id="section2" class="container-fluid bg-warning" style="padding:100px 20px;">
   
    <h1>Sobre nós</h1>
    <!--historia-->
    <p><br>&ensp;Sempre acreditei que a roupa tem o poder de transformar e, ao longo dos anos vi como uma peça bem feita e personalizada podia elevar a autoestima das pessoas. Dessa forma, muitas clientes chegavam ao ateliê inseguras e buscando algo que as fizesse se sentir mais bonitas e confiantes. <br>&ensp;Com "Sua Medida", busco criar roupas que valorizem a individualidade de cada cliente, realçando seus pontos fortes e disfarçando o que elas não gostam. A cada peça entregue, a alegria e a gratidão das clientes me motivam a continuar. A sustentabilidade se tornou parte do meu processo, pois acredito que cuidar do meio ambiente também é cuidar de nós mesmos.</p>
</div>

<div id="section3" class="container-fluid bg-secondary text-white" style="padding:100px 20px;">
    <!--formulario-->
  <h1>Cadastre-se</h1>

      <form action="../controladora/processa_cadastro.php" method="POST">
    <div class="mb-3 mt-3">
      <label for="nome">Nome:</label>
      <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" name="nome" required>
    </div>
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Digite seu email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="pwd">Senha:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Digite sua senha" name="pswd" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<div id="section4" class="container-fluid bg-secondary text-white" style="padding:100px 20px;">
<h1>Logue-se</h1>

<form action="../controladora/processa_login.php" method="POST">
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="mb-3">
                <label for="pswd">Senha:</label>
                <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        
        </form>

</div>

    <!-- Rodapé da página -->
<footer>
    <div class="footer-container">
    <div class="footer-section">
        <!-- Mapa do endereço -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3661.827625287934!2d-46.32479342518252!3d-23.3944523554805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce87785706619d%3A0x32fab1c5bd6fe009!2sSua%20Medida%20Ateli%C3%AA%20de%20Costura!5e0!3m2!1spt-BR!2sbr!4v1724029747272!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="footer-section">
        <h4>Início</h4>
        <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#section1">Roupas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section2">Sobre nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section3">Cadastre-se</a>
                </li>
            </ul>
    </div>
    <div class="footer-section">
        <h4>Informações</h4>
          <ul>
            <li> Sua Medida, transforma roupas personalizadas que refletem seu estilo. Nossa equipe dedicada cria peças com qualidade e criatividade, valorizando o processo artesanal e os detalhes que fazem a diferença. Aqui, seu estilo é a nossa inspiração. </li>
          </ul>
    </div>   
    <div class="footer-section social-media">
        <div class="footer-section"> 
            <h4>Contato</h4>
            <a href="https://www.instagram.com/suamedidaatelie?igsh=MXF2ODNwNTl4cXRpNQ=="><i> <img src="../img/insta.jpeg"> </i></a>
            <a href="https://wa.me/5511987654321" target="_blank" class="btn-whatsapp"><i> <img src="../img/wpp.jpg"> </i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>    
    <div class="footer-copyright">
        &copy; 2024 Sua Medida - Ateliê de costura
    </div>
        
        

    </footer>

</body>
</html>