<?php

namespace app\controller;

use app\core\Controller;
use app\model\PermissaoUsuarioModel;
use app\model\UsuarioModel;

class SessaoController extends Controller
{

    //Instância da classe PermissaoUsuarioModel
    private $sessao;

    // validação de rotas que necessita do usuário estar logado

    public function validacao($redirecionaLogin = true)
    {
        if (array_key_exists('autenticacao', $_SESSION)) {
            if (!$_SESSION['autenticacao']['status'] &&  $redirecionaLogin) {
                redirect('/login');
            } else if (!$_SESSION['autenticacao']['status']) {
                return false;
            } else {
                $permissaoUsuario = new PermissaoUsuarioModel();
                $direitoAcessarSistema = $permissaoUsuario->getById(1);
                if (!$direitoAcessarSistema) {
                    $this->encerrarSessao();
                }
            }
            return true;
        } else {
            redirect('/login');
        }
    }

    // Função para redirecionar da tela de login para home caso o usuário esteja com a sessão ativa
    public function validacaoTelaLogin()
    {
        if (array_key_exists('autenticacao', $_SESSION)) {
            if ($_SESSION['autenticacao']['status']) {
                redirect('/');
            }
        }
    }

    // Função encerrar uma sessão
    public function encerrarSessao()
    {
        $_SESSION['autenticacao']['usuario'] = null;
        $_SESSION['autenticacao']['status'] = false;
        redirect('/login');
    }
}
