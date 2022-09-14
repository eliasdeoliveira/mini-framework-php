<?php

namespace app\model;

use app\core\Model;

/**
 * Classe responsável por gerenciar a conexão com a tabela usuario.
 */
class UsuarioModel
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

    public function filterUserLogin(array $usuario)
    {
        $senhaMD5 = md5($usuario['senha']);
        $sql = "
        SELECT
            id_usuario,
            nome_usuario,
            telefone_usuario,
            email_usuario,
            senha_usuario,
            data_registro,
            situacao
        FROM usuario
        where 
        email_usuario = '{$usuario['email']}' AND 
        senha_usuario = '{$senhaMD5}' AND
        situacao = 'ativo'
        ";

        $dr = $this->pdo->executeQuery($sql);

        return $dr;
    }
}
