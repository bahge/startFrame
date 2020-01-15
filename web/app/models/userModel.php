<?php

namespace app\models;

use app\models\helpers\{modelsInsert, modelsRead, modelsUpdate, modelsDelete, modelsPagination};


class userModel{
    private $resultado;
    private $userId;
    private $dados;
    private $msg;
    private $rowCount;
    private $resultadoPaginacao;

    const Entity = 'users';

    /*
    * Função listar retorna os usuários cadastrados no banco de dados.
    * @access public
    * @param $pgId -> usado para paginação 
    * @return array de usuários
    */
    public function listar($pgId) {
        $paginacao = new modelsPagination(URL . 'userController/index/');
        $paginacao->condicao($pgId, 10);
        $this->resultadoPaginacao = $paginacao->paginacao('users');

        $listar = new modelsRead();
        $listar->listar(self::Entity, 'LIMIT :limit OFFSET :offset', "limit={$paginacao->getLimiteResultado()}&offset={$paginacao->getOffset()}");
        if ($listar->getResultado()):
            $this->resultado = $listar->getResultado();
            return array($this->resultado, $this->resultadoPaginacao);
        else:
            $paginacao->paginaInvalida();
        endif;
    }

    /*
    * Função cadastra, prepara os dados passados no formulário para cadastro no banco de dados users.
    * @access public
    * @param array $dados -> dados do usuário: nome, email, senha, nivel, status 
    * @return array de usuários
    */
    public function cadastrar(array $dados) {
        $this->dados = $dados;
        $this->ValidarDados();
        if ($this->resultado):
            unset($this->dados['SendCadUser']);
            $this->inserir();
            if ($this->resultado > 0):
                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong><br> Usuário cadastrado com sucesso!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            else:
                $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erro</strong> O usuário não foi cadastrado, verifique se algum dado ficou em branco, ou se não estão no padrão exigido.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            endif;
        endif;
    }

    /*
    * Função validarDados, remove tags e espaços dos campos e faz o hash no campo pass.
    * @access privado
    * @return boolean
    */
    private function validarDados(){
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)):
            $this->resultado = false;
        else:
            if (isset($this->dados['pass'])):
                $this->dados['pass'] = sha1(md5($this->dados['pass']));
            endif;
            $this->resultado = true;
        endif;
    }

    /*
    * Função inserir chama a model abstrata para inserir no banco de dados efetivamente.
    * @access privado
    * @return $this->resultado -> retorno da abastrata de inserção no banco de dados
    */
    private function inserir() {
        $insert = new modelsInsert;
        $insert->Inserir(self::Entity, $this->dados);
        if ($insert->getResultado()):
            $this->resultado = $insert->getResultado();
        endif;
    }

    /*
    * Função visualizar, retorna os dados do usuário chamado pelo ID.
    * @access public
    * @param userId -> id do usuário no BD
    * @return $this->resultado -> retorna os dados do usuário;
    */
    public function visualizar($userId) {
        $this->userId = (int) $userId;
        $visualizar = new modelsRead();
        $visualizar->listar(self::Entity, 'WHERE id =:id LIMIT :limit', "id={$this->userId}&limit=1");
        $this->resultado = $visualizar->getResultado();
        $this->rowCount = $visualizar->getRowCount();
        return $this->resultado;
    }

    /*
    * Função editar, prepara os dados passados no formulário para edição no banco de dados users.
    * @access public
    * @param userId -> id do usuário a ser editado, array dados -> dados do formulário de edição
    * @return void -> chama a função alterar
    */
    public function editar($userId, array $dados) {
        $this->userId = (int) $userId;
        $this->dados = $dados;
        $this->userId = $this->dados['id'];

        $this->validarDados();
        if ($this->resultado):
            $this->alterar();
        endif;
    }

    /*
    * Função alterar chama a model abstrata para alteração no banco de dados efetivamente.
    * @access privado
    * @return void -> retorna a alteração ou não por mensagem em $_SESSION
    */
    private function alterar() {
        $update = new modelsUpdate();
        $update->atualizar(self::Entity, $this->dados, "WHERE id = :id", "id={$this->userId }");
        if ($update->getResultado()):
            $this->resultado = true;
        else:
            $this->resultado = false;
        endif;
        if ($this->resultado):
            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucesso!</strong><br> Usuário editado com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        else:
            $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Erro</strong> O usuário não foi editado, verifique se algum dado ficou em branco, ou se não estão no padrão exigido.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        endif;
    }

    /*
    * Função apagar, recebe o id do usuário e remove do banco de dados.
    * @access public
    * @param userId -> recebe o id do usuário a ser apagado
    * @return void -> retorna a alteração ou não por mensagem em $_SESSION
    */
    public function apagar($userId) {
        $this->dados = $this->visualizar($userId);
        if ($this->getRowCount() > 0):
            $apagarUsuario = new modelsDelete();
            $apagarUsuario->apagar('users', 'WHERE id = :id', "id=$userId");
            $this->resultado = $apagarUsuario->getResultado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário apagado com sucesso.</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi encontrado o usuário.</div>";
        endif;
    }

    /*
    * Funções getters e setters dos parâmentro privados que podem ter interesse fora da instancia.
    * @access public 
    * @return Variados
    */
    public function getResultado() { return $this->resultado; }
    public function getMsg() { return $this->msg; }
    public function getRowCount() { return $this->rowCount; }

}