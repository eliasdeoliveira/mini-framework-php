<?php

$this->get('/', 'HomeController@home');
$this->get('/login', 'LoginController@index');
$this->post('/login/validacao', 'LoginController@validacao');
$this->post('/login/sair', 'SessaoController@encerrarSessao');
$this->get('/permissao/usuario/validacao', 'PermissaoUsuarioController@validaPermissao');
$this->get('/tarefas', 'TarefaController@index');
$this->post('/tarefa/store', 'TarefaController@store');
$this->get('/tarefa/excluir', 'TarefaController@excluir');
$this->post('/tarefa/put', 'TarefaController@put');
$this->post('/sessao/validacao', 'SessaoController@validacao');