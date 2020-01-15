<?php

namespace app\models;

use app\models\helpers\{modelsRead};

class homeModel{
    private $userId;
    private $resultado;
    private $userLogin;
    private $userSenha;
    private $rowCount;
    const Entity = 'users';
    
    /*
    * Função validar - acessa a abastrada de leitura e checa se os dados do usuário existem.
    * @access public
    * @param userLogin -> login do usuário, userSenha senha já com hash
    * @return $this->resultado -> retorna o resultado
    */
    public function validar($userLogin, $userSenha) {
        $this->userLogin = (string) $userLogin;
        $this->userSenha = (string) sha1(md5($userSenha));
        $carregar = new modelsRead();
        $carregar->listar(self::Entity, 'WHERE email="'.$this->userLogin.'" AND pass="'.$this->userSenha.'"');
        $this->resultado = $carregar->getResultado();
        return $this->resultado;
    }

}