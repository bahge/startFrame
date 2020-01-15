<?php

namespace app\models\helpers;

use app\models\helpers\modelsConn;

class modelsUpdate extends modelsConn{
    private $tabela;
    private $dados;
    private $termos;
    private $valores;
    private $resultado;
    private $msg;
    private $query;
    private $conn;

    public function atualizar($iTabela, array $iDados, $iTermos, $iParseString) {
        $this->tabela = (string) $iTabela;
        $this->dados = $iDados;
        $this->termos = $iTermos;
        parse_str($iParseString, $this->valores);
        $this->getQuerySQL();
        $this->exeAtualizar();
    }
    
    private function Conexao() {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }

    private function getQuerySQL() {
        foreach ($this->dados as $key => $value) {
            $valores[] = $key . ' = :' . $key;                    
        }
        $valores = implode(', ', $valores);
        $this->query = "UPDATE {$this->tabela} SET {$valores} {$this->termos}";
    }

    private function exeAtualizar(){
        $this->Conexao();
        try {
            $this->query->execute(array_merge($this->dados, $this->valores));
            $this->resultado = true;
            $this->msg = "<strong>Atualizado com sucesso</strong>";
        } catch (Exception $e) {
            $this->resultado = null;
            $this->msg = "<strong>Erro ao atualizar</strong><br> {$e->getMessage()}";
        }
    }
    
    public function getResultado() { return $this->resultado; }
    public function getMsg() { return $this->msg; }
    public function getRowCount() { return $this->Query->rowCount; }
}