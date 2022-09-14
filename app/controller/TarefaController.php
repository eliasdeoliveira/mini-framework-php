<?php

namespace app\controller;

use app\core\Controller;

use app\model\TarefaModel;
use app\classes\Input;
use app\model\PermissaoUsuarioModel;

class TarefaController extends Controller
{
    private $tarefaModel;
    private $permissaoUsuario;

    /**
     * Método construtor
     *
     * @return void
     */
    public function __construct()
    {
        $this->tarefaModel = new TarefaModel();
        $this->permissaoUsuario = new PermissaoUsuarioModel();
        $sessao = new SessaoController();
        $permissaoUsuario = new PermissaoUsuarioModel();
        $direitoAcessarSistema = $permissaoUsuario->getById(1);
        if (!$direitoAcessarSistema) {
            $sessao->encerrarSessao();
        }
    }

    public function index()
    {
        $dados['titulo'] = 'Tarefas';
        $dados['dependenciasJS'] = [
            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js'
        ];
        $dados['permissao']['visualizar'] = $this->permissaoUsuario->getById(2);
        $dados['permissao']['cadastrar'] = $this->permissaoUsuario->getById(3);
        $dados['permissao']['editar'] = $this->permissaoUsuario->getById(4);
        $dados['permissao']['excluir'] = $this->permissaoUsuario->getById(5);
        $dados['permissao']['gerarRelatorio'] = $this->permissaoUsuario->getById(6);
        $params = [];
        $url  = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        if (array_key_exists('query', $url_components)) {
            parse_str($url_components['query'], $params);
        }
        $dados['crud'] = (array_key_exists('crud', $params) === true ? $params['crud'] : false);
        $dados['lista'] = $this->tarefaModel->getAll();
        $this->load('template/header', $dados);
        if ($dados['permissao']['visualizar']) {
            $this->load('tarefa/main', $dados);
        } else {
            $this->load('errors/nao-possui-permissao', $dados);
        }
        $this->load('template/footer');
    }

    public function store()
    {
        $tarefa = $_POST;
        $resultado = $this->tarefaModel->store($tarefa);
        if ($resultado <= 0) {
            die();
        } else {
            redirect(base_url . '/tarefas?crud=cadastrada');
        }
    }

    public function put()
    {
        $tarefa = $_POST;
        $resultado = $this->tarefaModel->put($tarefa);
        if ($resultado < 0 && $resultado === false) {
            die();
        } else {
            redirect(base_url . '/tarefas?crud=atualizada');
        }
    }

    public function excluir()
    {
        $url  = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        if (!empty($params['id_tarefa'])) {
            $tarefa = $_POST;
            $resultado = $this->tarefaModel->delete($params['id_tarefa']);
            if ($resultado < 0 && $resultado === false) {
                die();
            } else {
                redirect(base_url . '/tarefas?crud=excluida');
            }
        } else {
            redirect(base_url . '/tarefas');
        }
    }
}
