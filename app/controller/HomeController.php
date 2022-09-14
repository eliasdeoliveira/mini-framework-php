<?php

namespace app\controller;

use app\core\Controller;
use app\Controller\SessaoController;

class HomeController extends Controller
{
    private $sessao;

    public function __construct()
    {
        $this->sessao = new SessaoController();
        $this->sessao->validacao();
    }

    public function home()
    {
        $dados['titulo'] = 'Inicio';
        $this->load('template/header', $dados);
        $this->load('home/main');
        $this->load('template/footer');
    }
}
