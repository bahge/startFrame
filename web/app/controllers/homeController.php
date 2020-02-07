<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }

use app\config\configView;
use app\models\homeModel;

class homeController{
    private $userLogin;
    private $userPass;
    private $dados;
    const urlDestino = URL;

    /*
    * Função index, passa a configView a view index a ser renderizada
    * @access public
    * @return void
    */
    public function index(){
        $carregarView = new configView('index', $this->dados);
        $carregarView->renderizar();
    }

    /*
    * Função login, verifica se há dados enviados via POST se hpa procede a validação e carrega a view correspondente
    * @access public
    * @return view login com erro ou adm;
    */
    public function login(){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $login = new homeModel();
        if (!empty($this->dados)):
            $result = $login->validar($this->dados['login'], $this->dados['pass']);
            if (isset($result[0]['id'])):
                $this->logar($result);
                $this->adm();
                exit;
            else:
                $_SESSION['msg'] = alertaMsg('alert-warning', 'Verifique os dados do login.');
            endif;
            
        endif;
        $carregarView = new configView('login');
        $carregarView->renderizar();
    }

    /*
    * Função adm, carrega a view do painel administrativo
    * @access public
    * @return void
    */
    public function adm(){
        if (logado()){
            $carregarView = new configView('adm');
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = alertaMsg('alert-warning', 'Apenas usuários logados podem acessar.');
            header("Location:" . self::urlDestino);
        }
        
    }

    /*
    * Função logar cria a sessão do usuário
    * @access privado
    * @param array usuario -> dados do usuário: id, nome, email, nivel, status
    * @return void
    */
    private function logar(array $usuario){
        if (isset($usuario)):
            $_SESSION['usuario']['id'] = $usuario[0]['id'];
            $_SESSION['usuario']['nome'] = $usuario[0]['nome'];
            $_SESSION['usuario']['email'] = $usuario[0]['email'];
            $_SESSION['usuario']['nivel'] = $usuario[0]['nivel'];
            $_SESSION['usuario']['status'] = $usuario[0]['status'];
        endif;
    }

    /*
    * Função deslogar, remove as variáveis da SESSION[usuario] e destroi a sessão
    * @access public
    * @return void
    */
    public function deslogar(){
        if ($_SESSION['usuario']['id']):
            unset($_SESSION['usuario']['id']);
            unset($_SESSION['usuario']['nome']);
            unset($_SESSION['usuario']['email']);
            unset($_SESSION['usuario']['nivel']);
            unset($_SESSION['usuario']['status']);
            session_destroy();
        endif;
        header("Location:" . self::urlDestino);
    }
}