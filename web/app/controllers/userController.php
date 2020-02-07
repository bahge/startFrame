<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }

use app\config\configView;
use app\models\userModel;

class userController{
    private $dados;
    private $pgId;
    private $userId;
    const urlDestino = URL . 'userController/index';

    /*
    * Função index carrega a index do painel adm
    * @access public
    * @param pgId, recebe a paǵina (ainda em implantação)
    * @return void
    */
    public function index($pgId = null){
        if(logado()):
            $this->pgId = ((int) $pgId ? $pgId : 1);

            $ListaUsuario = new userModel();
            $this->dados = $ListaUsuario->listar($this->pgId);

            $carregarView = new configView('user/index', $this->dados);
            $carregarView->renderizar();
        else:
            $_SESSION['msg'] = alertaMsg('alert-danger', 'Área restrita, apenas usuários logados podem ter acesso');
            header('Location:' . URL);
        endif;
    }

    /*
    * Função cadastrar, verifica se a dados enviado por post e carrega a model para tratamento.
    * @access public
    * @return void
    */
    public function cadastrar(){
        if(logado()):
            $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $CadUsuario = new userModel();
            if (!empty($this->dados)):
                $CadUsuario->cadastrar($this->dados);
                
            endif;

            $carregarView = new configView('user/cadastrar');
            $carregarView->renderizar();
        else:
            $_SESSION['msg'] = alertaMsg('alert-danger','Área restrita, apenas usuários logados podem ter acesso');
            header('Location:' . URL);
        endif;
    }

    /*
    * Função visualizar, recebe o id do usuário, verifica se foi repassado e carrega a model
    * @access public
    * @param userId -> id do usuário
    * @return void
    */
    public function visualizar($userId = null) {
        if(logado()):
            $this->userId = (int) $userId;
            if (!empty($this->userId)):
                $verUser = new userModel();
                $this->dados = $verUser->visualizar($userId);

                if ($verUser->getResultado()):
                    $carregarView = new configView("user/visualizarUser", $this->dados);
                    $carregarView->renderizar();
                else:
                    $_SESSION['msg'] = alertaMsg('alert-warning', 'Necessário selecionar um Usuário!');
                    header("Location: " . self::urlDestino);
                endif;

            else:
                $_SESSION['msg'] = alertaMsg('alert-warning', 'Necessário selecionar um Usuário!');   
                header("Location: " . self::urlDestino);
            endif;
        else:
            $_SESSION['msg'] = alertaMsg('alert-danger','Área restrita, apenas usuários logados podem ter acesso');
            header('Location:' . URL);
        endif;
    }

    /*
    * Função editar, recebe o id do usuário, verifica se foi repassado e chama a função atualizar
    * @access public
    * @param userId -> id do usuário
    * @return void
    */
    public function editar($userId = null) {
        if(logado()):
            $this->userId = (int) $userId;
            if (!empty($this->userId)):
                $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                $this->atualizar();

                $carregarView = new ConfigView("user/editarUser", $this->dados);
                $carregarView->renderizar();
            else:
                $_SESSION['msg'] = alertaMsg('alert-warning', 'Necessário selecionar um Usuário!');   
                header("Location: " . self::urlDestino);
            endif;
        else:
            $_SESSION['msg'] = alertaMsg('alert-danger','Área restrita, apenas usuários logados podem ter acesso');
            header('Location:' . URL);
        endif;
    }

    /*
    * Função atualizar prepara os dados para carregar a model de editar o usuário
    * @access private
    * @return void
    */
    private function atualizar() {
        if (!empty($this->dados)):
            unset($this->dados['SendEditUser']);
            if ($this->dados['pass'] == ''):
                unset($this->dados['pass']);
            endif;
            $editarUsuario = new userModel();
            $editarUsuario->editar($this->userId, $this->dados);
            if (!$editarUsuario->getResultado()):
                $_SESSION['msg'] = alertaMsg('alert-warning', 'Para editar todos os campos devem ser preenchidos!');
            else:
                $_SESSION['msg'] = alertaMsg('alert-success', 'Usuário editado com sucesso!');
                header("Location: " . self::urlDestino);
            endif;
        else:
            $verUser = new userModel();
            $this->dados = $verUser->visualizar($this->userId);
            if ($verUser->getRowCount() <= 0):
                $_SESSION['msg'] =  alertaMsg('alert-warning', 'Necessário selecionar um Usuário!');   
                header("Location: " . self::urlDestino);
            endif;
        endif;
    }

    /*
    * Função apagar, recebe o id do usuário, verifica se foi repassado e chama a model para remover o usuário
    * @access public
    * @param userId -> id do usuário
    * @return void
    */
    public function apagar($userId = null) {
        if(logado()):
            $this->userId = (int) $userId;
            if (!empty($this->userId)):
                echo "Usuário a ser apagado: {$this->userId}<br>";
                $ApagarUsuario = new userModel();
                $ApagarUsuario->apagar($this->userId);
            else:
                $_SESSION['msg'] =  alertaMsg('alert-warning', 'Necessário selecionar um Usuário!');   
            endif;
            header("Location: " . self::urlDestino);
        else:
            $_SESSION['msg'] = alertaMsg('alert-danger','Área restrita, apenas usuários logados podem ter acesso');
            header('Location:' . URL);
        endif;
    }


}