<?php

namespace app\model;

use app\core\Model;

/**
 * Classe responsável por gerenciar a conexão com a tabela Permissao.
 */
class PermissaoModel
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
     * Insere um novo registro na tabela de Permissao e retorna seu ID em caso de sucesso
     *
     * @param  Object $params Lista com os parâmetros a serem inseridos
     * @return int Retorna o ID do Permissao inserido ou -1 em caso de erro
     */

    public function getById(int $id_permissao)
    {
        if (!empty($_SESSION['autenticacao']['usuario']['id_usuario'])) {
            $sql = "
            SELECT 
                id_permissao,
                nome_permissao,
                data_registro,
                situacao
            FROM permissao
            where 
            id_permissao = :id_permissao
        ";

            $param = [
                // ':usuario_id' => $_SESSION['autenticacao']['usuario']['usuario_id'],
                ':id_permissao' => $id_permissao
            ];

            $dr = $this->pdo->executeQueryOneRow($sql, $param);

            return true;
        } 
        return false;
    }
}
