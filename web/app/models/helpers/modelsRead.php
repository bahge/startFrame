<?php

namespace app\models\helpers;

use app\models\helpers\modelsConn;
use PDO;

class modelsRead extends modelsConn{
    private $select;
    private $values;
    private $resultado;
    private $msg;
    private $query;
    private $conn;

    public function listar($tabela, $termos = null, $parseString = null) {
        if (!empty($parseString)):
            parse_str($parseString, $this->values);
        endif;

        $this->select = "SELECT * FROM {$tabela} {$termos}";
        $this->exeListar();
    }
    
    public function listarTodos($query, $parseString = null) {
        $this->select = (string) $query;
        if(!empty($parseString)):
            parse_str($parseString, $this->values);
        endif;
        $this->exeListar();
    }
   
    public function getRowCount() {
        return $this->query->rowCount();
    }

    private function Conexao() {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getQuerySQL() {
        if ($this->values):
            foreach ($this->values as $link => $valor):
                if ($link == 'limit' || $link == 'offset'):
                    $valor = (int) $valor;
                endif;
                $this->query->bindValue(":{$link}", $valor, ( is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    private function exeListar() {
        $this->Conexao();
        try {
            $this->getQuerySQL();
            $this->query->execute();
            $this->resultado = $this->query->fetchAll();
        } catch (PDOException $e) {
            $this->resultado = null;
            return "<strong>Erro ao carregar lista</strong><br> {$e->getMessage()}";
        }
    }    

    public function getResultado() { return $this->resultado; }
    public function getMsg() { return $this->msg; }

}