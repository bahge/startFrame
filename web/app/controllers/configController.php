<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }
use app\config\configView;
use app\models\configModel;

class configController{
    private $dados;
    private $cfg;
    const urlDestino = URL . 'configController/index';

    public function index(){
        if (logado()):
            if (isset($_POST['nome'])):
                $this->salvar();
            endif;
            $this->dados = $this->lerConfig();
            $carregarView = new configView('config/index', $this->dados);
            $carregarView->renderizar();
            

        else:
            $_SESSION['msg'] = alertaMsg('alert-warning', 'Apenas usuários logados podem acessar.');
            header('Location:' . URL);
        endif;
    }

    public function cfg(){
        $this->cfg = $this->lerConfig();
        return $this->cfg;
    }

    private function lerConfig(){
        $arquivo = fopen ("./config/start.cfg", 'r');
            $string = file_get_contents("./config/start.cfg");
        fclose($arquivo);
        foreach (explode("\n", $string) as $linha) {
            $configs[
                substr($linha, 0, (int) strpos($linha, ':'))
                    ] = substr($linha, (int) strpos($linha, ':') + 1, (int) strlen($linha));
        }
        return $configs;
    }

    private function salvar(){
        if (logado()):
            $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $cadConfig = new configModel;
            $cadConfig->salvarArquivo($this->dados);
        else:
            $_SESSION['msg'] = alertaMsg('alert-warning', 'Apenas usuários logados podem acessar.');
            header('Location:' . URL);
        endif;

    }
    
}