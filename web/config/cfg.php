<?php
/*
* Constantes básicas para o funcionamento do FrameWork;
*/
define('URL', 'http://start.local/');
define('ABS_USE', 'app\controllers');
define('CONTROLLER', 'homeController');
define('METHOD', 'index');
define('APP_TITLE', 'startFrameWork');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'qwaszx12');
define('DB_NAME', 'db_land');

/*
* Função de ajuda no desenvolvimento recebe a variável e executa o var_dump e encerra a aplicação.
* @access public
* @param $var -> variável a ser "dumpada";
* @return void
*/
function dd($var) {
    var_dump($var);
    die;
}

/*
* Função de ajuda para substituição do código do status para string e vice versa.
* @access public
* @param $valor -> numérico para o código e string para a descrição;
* @return string or number
*/
function statusCod($valor){
    if ( is_numeric($valor) ):
        switch ($valor) {
            case 0:  return 'Inativo'; break;
            default: return 'Ativo'; break;
        }
    else:
        switch ($valor) {
            case 'Inativo': return 0; break;
            default: return 1; break;
        }
    endif;
}

/*
* Função de ajuda para substituição do código do nivel para string e vice versa.
* @access public
* @param $valor -> numérico para o código e string para a descrição;
* @return string or number
*/
function nivelCod($valor){
    if ( is_numeric($valor) ):
        switch ($valor) {
            case 0:  return 'Administrador'; break;
            case 1:  return 'Supervisor'; break;
            case 2:  return 'Coordenador'; break;
            default: return 'Usuário'; break;
        }
    else:
        switch ($valor) {
            case 'Administrador':  return 0; break;
            case 'Supervisor':  return 1; break;
            case 'Coordenador':  return 2; break;
            default: return 3; break;
        }
    endif;
}

/*
* Função teste de login.
* @access public
* @return boolean
*/
function logado(){
    if (isset($_SESSION['usuario']['id'])) {
        return true;
    } else {
        return false;
    }
}

/*
* Função de formatação de alertas
* @access public
* @return string
*/
function alertaMsg($formatacao, $alerta){
    $string = '<div class="alert '.$formatacao.' alert-dismissible fade show" role="alert">
    <strong>Alerta</strong><br>
    '.$alerta.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  return $string;
}