<?php

namespace app\model;

use app\core\Model;

/**
 * Classe responsável por gerenciar a conexão com a tabela Permissão do usuário.
 */
class PermissaoUsuarioModel
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
     * Insere um novo registro na tabela de Permissão do usuário e retorna seu ID em caso de sucesso
     *
     * @param  Object $params Lista com os parâmetros a serem inseridos
     * @return int Retorna o ID do Permissão do usuário inserido ou -1 em caso de erro
     */

    public function getById(int $permissao_id)
    {
        if (!empty($_SESSION['autenticacao']['usuario']['id_usuario'])) {
            $usuario_id = $_SESSION['autenticacao']['usuario']['id_usuario'];
            $sql = "
            SELECT 
                permissao_id,
                usuario_id,
                situacao
            FROM permissao_usuario
            where 
            permissao_id = {$permissao_id} AND 
            usuario_id = {$usuario_id} AND
            situacao = 'ativo'
            ";
            $dr = $this->pdo->executeQueryOneRow($sql, null);
            if ($dr !== false) {
                return true;
            }
            return false;
        }
        return false;
    }
}
