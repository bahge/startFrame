<?php

namespace app\models;
use Exception;

class configModel{
    private $dados;
    private $cfg;

    const arqpath = './config/';

    public function salvarArquivo(array $dados){

        $string = '';
        foreach ($dados as $config => $value) {
            $string .= $config . ':' . $value . "\n";
        }

        try {
            $arquivo = self::arqpath . 'start.cfg';

            if ( !file_exists($arquivo) ) { throw new Exception('Arquivo não encontrado.'); }

            $arq = fopen($arquivo, "w+");

            if ( !$arq ) { throw new Exception('Falha na abertura do arquivo.'); }  
        
            if (!fwrite($arq, $string)) { throw new Exception('Falha ao gravar o conteúdo no arquivo'); }
        
            fclose($arq);

            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucesso!</strong><br> Arquivo de configurações atualizado!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

        } catch ( Exception $e ) {
            $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Erro</strong><br> Não foi possível atualizar o arquivo.<br>' . $e->getMessage() . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }
    }

    public function configs(){
      $arquivo = fopen (self::arqpath . 'start.cfg', 'r');
          $string = file_get_contents(self::arqpath . 'start.cfg');
      fclose($arquivo);
      foreach (explode("\n", $string) as $linha) {
          $configs[
              substr($linha, 0, (int) strpos($linha, ':'))
                  ] = substr($linha, (int) strpos($linha, ':') + 1, (int) strlen($linha));
      }
      return $configs;
  }

    
}