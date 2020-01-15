<?php

namespace app\config;

class configController{

    private $Url;
    private $UrlConjunto;
    private $UrlController;
    private $UrlMetodo;
    private $UrlParamentro;
    private static $Format;
    
    /*
    * Função construtora do configController.
    * @access public 
    * @return void 
    */
    public function __construct() {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))):
            $this->setUrl(filter_input(INPUT_GET, 'url', FILTER_DEFAULT));
            $this->limparUrl();
            $this->setUrlConjunto(explode("/", $this->getUrl()));
            if (isset($this->UrlConjunto[0])):
                $this->setUrlController(ABS_USE . '\\' . $this->UrlConjunto[0]);
            endif;
            if (isset($this->UrlConjunto[1])):
                $this->setUrlMetodo($this->UrlConjunto[1]);
            endif;

            if (isset($this->UrlConjunto[2])):
                $this->setUrlParamentro($this->UrlConjunto[2]);
            else:
                $this->setUrlParamentro(null);
            endif;
        else:
            $UrlController = ABS_USE . '\\' . CONTROLLER;
            $this->setUrlController($UrlController);
            $this->setUrlMetodo(METHOD);
        endif;
    }
    
    /*
    * Função que remove caracteres especiais da url.
    * @access public 
    * @return void 
    */
    public function limparUrl() {
        $this->setUrl(strip_tags($this->getUrl()));
        $this->setUrl(trim($this->getUrl()));
        $this->setUrl(rtrim($this->getUrl(), "/"));

        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->setUrl(strtr(utf8_decode($this->getUrl()), utf8_decode(self::$Format['a']), self::$Format['b']));
    }

    /*
    * Função que carrega o controller.
    * @access public 
    * @return carrega o controle passado na URL 
    */
    public function carregar() {
        $UrlController = ABS_USE . '\\' . CONTROLLER;
        if (class_exists($this->getUrlController())):
            try {
                $this->carregarMetodo();
            } catch (Exception $e) {
                $this->setUrlController($UrlController);
                $this->UrlMetodo = METHOD;
                $this->carregar();
            }
        else:
            $this->setUrlController($UrlController);
            $this->setUrlMetodo(METHOD);
            $this->carregar();
        endif;
    }

    /*
    * Função que carrega o metodo do controller carregado.
    * @access public 
    * @return carrega o metódo passado na URL
    */
    public function carregarMetodo() {
        $classe = $this->getUrlController();
        $classeCarregar = new $classe;
        if (method_exists($classeCarregar, $this->UrlMetodo)):
            if ($this->UrlParamentro !== null):
                $classeCarregar->{$this->UrlMetodo}($this->UrlParamentro);
            else:
                $classeCarregar->{$this->UrlMetodo}();
            endif;

        else:
            echo 'Erro ao carregar método';
        endif;
    }

    /*
    * Funções getters e setters dos parâmentro privados que podem ter interesse fora da instancia.
    * @access public 
    * @return Variados
    */
    public function getUrl() { return $this->Url; }
    public function setUrl($Url) { $this->Url = $Url; }

    public function getUrlConjunto() { return $this->UrlConjunto; }
    public function setUrlConjunto($UrlConjunto) { $this->UrlConjunto = $UrlConjunto; }

    public function getUrlController() { return $this->UrlController; }
    public function setUrlController($UrlController) { $this->UrlController = $UrlController; }

    public function getUrlMetodo() { return $this->UrlMetodo; }
    public function setUrlMetodo($UrlMetodo) { $this->UrlMetodo = $UrlMetodo; }

    public function getUrlParamentro() { return $this->UrlParamentro; }
    public function setUrlParamentro($UrlParamentro) { $this->UrlParamentro = $UrlParamentro; }
}