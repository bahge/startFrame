<?php

namespace app\models\helpers;

use app\models\helpers\modelsConn;

class modelsInsert extends modelsConn{
    private $tabela;
    private $dados;
    private $resultado;
    private $msg;
    private $query;
    private $conn;

    public function Inserir($iTabela, array $iDados) {
        $this->tabela = (string) $iTabela;
        $this->dados = $iDados;

        $this->getQuerySQL();
        $this->exeInserir();
    }

    private function Conexao() {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }

    private function getQuerySQL(){
        $keys =  implode(', ', array_keys($this->dados));
        $values = ":" . implode(', :', array_keys($this->dados));
        
        $this->query = "INSERT INTO {$this->tabela} ({$keys}) VALUES ({$values})";
    }

    private function exeInserir() {
        $this->Conexao();
        try {
            $this->query->execute($this->dados);
            $this->resultado = $this->conn->lastInsertId();
        } catch (Exception $e) {
            $this->resultado = null;
            $this->msg = "<strong>Erro ao cadastrar</strong><br> {$e->getMessage()}";
        }
    }
    
    public function getResultado() { return $this->resultado; }
    public function getMsg() { return $this->msg; }
}