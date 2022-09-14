<?php

namespace app\controller;

use app\core\Controller;
use app\model\UsuarioModel;
use app\controller\SessaoController;

class LoginController extends Controller
{

    private $sessao;
    //Instância da classe UsuarioModel
    private $usuarioModel;

    /**
     * Método construtor
     *
     * @return void
     */
    public function __construct()
    {
        $this->sessao = new SessaoController();
        $this->sessao->validacaoTelaLogin();
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        $dados = [];
        $url  = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        if (array_key_exists('query', $url_components)) {
            (parse_str($url_components['query'], $params));
            $dados['erro'] = $params['erro'];
        }
        $this->load('login/main', $dados);
    }

    public function validacao()
    {
        $tarefa = $_POST;
        $resposta = $this->usuarioModel->filterUserLogin($tarefa);
        if (!empty($resposta)) {
            $_SESSION['autenticacao']['usuario'] = $resposta[0];
            $_SESSION['autenticacao']['status'] = true;
            redirect('/');
        }
        redirect('/login?erro=true');
    }
}
