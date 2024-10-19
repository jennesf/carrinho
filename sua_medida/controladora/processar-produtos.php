<?php
session_start();
include_once '../controladora/conexao.php';
include_once '../Modelo/Produto.php';
include_once '../controladora/ProdutoRepositorio.php';

// Verifica se os dados do produto foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria um objeto Produto com os dados recebidos
    $nome = $_POST['nome'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $imagem = $_POST['imagem'] ?? null; // Caso a imagem não seja obrigatória, pode ser null
    $descricao = $_POST['descricao'] ?? ''; // Adicionando a descrição

    // O ID pode ser null, pois será gerado automaticamente pelo banco de dados
    $produto = new Produto(null, $nome, $tipo, $preco, $imagem, $descricao);
    
    // Instancia o repositório e chama o método cadastrar
    $produtoRepositorio = new ProdutoRepositorio($conn);
    $resultado = $produtoRepositorio->cadastrar($produto);

    // Verifica se o produto foi cadastrado com sucesso
    if ($resultado) {
        $_SESSION['mensagem'] = 'Produto cadastrado com sucesso!';
    } else {
        $_SESSION['mensagem'] = 'Erro ao cadastrar o produto!';
    }

    // Redireciona de volta para a página de administração
    header('Location: admin.php');
    exit;
}
?>

