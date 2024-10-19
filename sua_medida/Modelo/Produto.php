<?php
class Produto {
    public $id;
    public $nome;
    public $tipo;
    public $preco;
    public $imagem;
    public $descricao; // Certifique-se de adicionar a propriedade 'descricao'

    // Construtor da classe
    public function __construct($id, $nome, $tipo, $preco, $imagem = null, $descricao = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->preco = $preco;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
    }

    // Métodos getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getDescricao() {
        return $this->descricao;
    }
}

