<?php

namespace app\controller;

use app\core\Controller;

use app\model\PermissaoModel;
use app\model\PermissaoUsuarioModel;


class PermissaoUsuarioController extends Controller
{
    // Instância da classe PermissaoModel
    private $permissaoModel;

    /**
     * Método construtor
     *
     * @return void
     */
    public function __construct()
    {
        $this->permissaoModel = new PermissaoModel();
        $this->permissaoUsuarioModel = new PermissaoUsuarioModel();
    }

    public function validaPermissao()
    {
        $url  = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $resposta = $this->permissaoUsuarioModel->getById($params['id_permissao']);
        if (!empty($resposta) && $resposta !== false) {
            return true;
        } else {
            return true;
        }
    }
}
