<?php

namespace app\models\helpers;

use app\models\helpers\modelsConn;

class modelsDelete extends modelsConn{
    private $tabela;
    private $termos;
    private $valores;
    private $resultado;
    private $msg;
    private $query;
    private $conn;
    
    public function apagar($iTabela, $iTermos, $iParseString){
        $this->tabela = (string) $iTabela;
        $this->termos = (string) $iTermos;
        parse_str($iParseString, $this->valores);
        $this->getQuerySQL();
        $this->exeApagar();
    }

    private function Conexao() {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }

    private function getQuerySQL() {
        $this->query = "DELETE FROM {$this->tabela} {$this->termos}";
    }

    private function exeApagar() {
        $this->Conexao();
        try {
            $this->query->execute($this->valores);
            $this->resultado = true;
            $this->msg = "<strong>Registro apagado com sucesso</strong>";
        } catch (Exception $e) {
            $this->resultado = null;
            $this->msg = "<strong>Erro ao apagar</strong><br> {$e->getMessage()}";
        }
    }

    public function getResultado() { return $this->resultado; }
    public function getMsg() { return $this->msg; }
}