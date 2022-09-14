<?php

namespace app\model;

use app\core\Model;

/**
 * Classe responsável por gerenciar a conexão com a tabela tarefa.
 */
class TarefaModel
{

    //Instância da classe model
    private $pdo;

    /**
     * Método construtor
     *
     * @return void
     */
    public function __construct()
    {
        $this->pdo = new Model();
    }

    /**
     * Insere um novo registro na tabela de tarefas e retorna seu ID em caso de sucesso
     *
     * @param  Object $params Lista com os parâmetros a serem inseridos
     * @return int Retorna o ID do tarefa inserido ou -1 em caso de erro
     */

    public function getAll()
    {
        if (!empty($_SESSION['autenticacao']['usuario']['id_usuario'])) {

            $usuario_id = $_SESSION['autenticacao']['usuario']['id_usuario'];

            $sql = "
            SELECT 
                id_tarefa,
                nome_tarefa,
                descricao_tarefa,
                data_registro,
                DATE_FORMAT(data_registro, '%d/%m/%Y %H:%i:%s') AS data_registro_formatado,
                data_conclusao,
                DATE_FORMAT(data_conclusao, '%d/%m/%Y %H:%i:%s') AS data_conclusao_formatado,
                usuario_criacao,
                situacao
            FROM tarefa
            where 
            usuario_criacao = {$usuario_id} AND 
            situacao != 'inativo' 
            ORDER BY id_tarefa DESC 
            ";

            $resposta = $this->pdo->executeQuery($sql);

            return $resposta;
        }
        return [];
    }

    public function store($dados)
    {
        if (!empty($_SESSION['autenticacao']['usuario']['id_usuario'])) {
            $usuario_id = $_SESSION['autenticacao']['usuario']['id_usuario'];
            $situacao = ($dados['situacao'] === 'on' ? 'concluido' : 'pendente');
            $sql = "
            INSERT INTO tarefa
            (
                nome_tarefa,
                descricao_tarefa,
                usuario_criacao,
                usuario_alteracao,
                situacao
            )
            VALUES
            (
                '{$dados['nome_tarefa']}',
                \"{$dados['descricao_tarefa']}\",
                {$usuario_id},
                {$usuario_id},
                '{$situacao}'
            ) ;";
            $this->pdo->executeNonQuery($sql);
            return $this->pdo->getLastID();
        }
        return [];
    }

    public function put($dados)
    {
        if (!empty($_SESSION['autenticacao']['usuario']['id_usuario'])) {
            $usuario_id = $_SESSION['autenticacao']['usuario']['id_usuario'];
            $situacao = '';
            if (array_key_exists('situacao', $dados)) {
                $situacao = ($dados['situacao'] === 'on' ? 'concluido' : 'pendente');
            }
            $data_conclusao = date('Y-m-d H:i:s');
            if ($situacao === 'concluido' && array_key_exists('situacao', $dados)) {
                $sql = "
                UPDATE tarefa SET
                    nome_tarefa = \"{$dados['nome_tarefa']}\",
                    descricao_tarefa = \"{$dados['descricao_tarefa']}\",
                    data_conclusao = '{$data_conclusao}',
                    usuario_alteracao = {$usuario_id},
                    situacao = '{$situacao}'
                WHERE id_tarefa = {$dados['id_tarefa']} ";
            } else {
                $sql = "
                UPDATE tarefa SET
                    nome_tarefa = \"{$dados['nome_tarefa']}\",
                    descricao_tarefa = \"{$dados['descricao_tarefa']}\",
                    usuario_alteracao = {$usuario_id}
                WHERE id_tarefa = {$dados['id_tarefa']}";
            }
            $this->pdo->executeQuery($sql);
            return $this->pdo->getLastID();
        }
        return [];
    }

    public function delete($id_tarefa)
    {
        if (!empty($_SESSION['autenticacao']['usuario']['id_usuario'])) {
            $sql = "
                UPDATE tarefa SET
                    situacao = 'inativo'
                WHERE id_tarefa = {$id_tarefa} ";
            $this->pdo->executeQuery($sql);
            return $this->pdo->getLastID();
        }
        return [];
    }
}
