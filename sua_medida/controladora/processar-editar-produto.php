<?php
session_start();
require '../visao/Menu.php';
require_once "conexao.php";
require 'ProdutoRepositorio.php';
require '../Modelo/Produto.php';
// ...

//$codigo = rand(0, 100000);
$produtosRepositorio = new ProdutoRepositorio($conn);

if (isset($_POST['editar'])){
  $produto = new Produto($_POST['id'], 
  $_POST['tipo'], $_POST['nomeP'], $_POST['descricao'], $_POST['preco']);


    //se a imagem foi carregada
    if (isset($_FILES['imagem']['name']) && ($_FILES['imagem']['error'] == 0)){
        $testeImagem = true;
        $produto->setImagem(uniqid() . $_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $produto->getImagem());
    }elseif ($_FILES['imagem']['error'] == UPLOAD_ERR_NO_FILE){
      $produto->setImagem('');
    }

  
    $imagem = $_FILES['imagem']['name'];
    $imagemError = $_FILES['imagem']['error'];
    
    $produtosRepositorio->atualizarProduto($produto);
  //  header("Location: ../visao/admin.php?codedit=$codigo");
    $nomeusuario = $_POST['nomeusuario'];
    $usuario = $_POST['usuario'];
    echo "<form id='redirectForm' action='../visao/admin.php?imagemNome={$imagem}&testeError={$imagemError}&teste={$teste}' method='POST'>";
    echo "<input type='hidden' name='id' value='{$_POST['id']}'>";
    echo "<input type='hidden' name='tipo' value='{$_POST['tipo']}'>";
    echo "<input type='hidden' name='nomeP' value='{$_POST['nomeP']}'>";
    echo "<input type='hidden' name='nomeusuario' value='{$nomeusuario}'>";
    echo "<input type='hidden' name='usuario' value='{$usuario}'>";
    echo "<input type='hidden' name='preco' value='{$_POST['preco']}'>";
    echo "</form>";
    echo "<script>document.getElementById('redirectForm').submit();</script>";



}