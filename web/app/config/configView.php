<?php

namespace app\config;

class configView {

    private $nome;
    private $dados;

    /*
    * Função construtora do configView, pega o nome e os dados da view.
    * @access public 
    * @return void 
    */
    public function __construct($nome, array $dados = null) {
        $this->nome = (string) $nome;
        $this->dados = $dados;
    }

    /*
    * Função responsável pela renderização da view com os includes necessários.
    * @access public 
    * @return void 
    */
    public function renderizar() {
        include './app/views/include/header.php';
        include './app/views/include/menu.php';
        if (file_exists( './app/views/' . $this->nome . '.php')):
            include './app/views/' . $this->nome . '.php';
        else:
            echo "Erro ao carregar a VIEW: {$this->nome}";
        endif;
        include './app/views/include/footer.php';
    }

    /*
    * Funções getters e setters dos parâmentro privados que podem ter interesse fora da instancia.
    * @access public 
    * @return Variados
    */
    public function getdados() {
        return $this->dados;
    }

}