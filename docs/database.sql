CREATE DATABASE IF NOT EXISTS meuframework;

use meuframework;

CREATE TABLE IF NOT EXISTS usuario (
    id_usuario int auto_increment,
    nome_usuario varchar(255) not null,
    telefone_usuario varchar(30) not null,
    email_usuario varchar(255) not null,
    senha_usuario varchar(255) not null,
    data_registro datetime default NOW(),
    situacao enum('ativo', 'inativo') default 'ativo' not null,
    primary key(id_usuario)
);

CREATE TABLE IF NOT EXISTS permissao (
    id_permissao int auto_increment,
    nome_permissao varchar(255) not null,
    data_registro datetime default NOW(),
    situacao enum('ativo', 'inativo') default 'ativo' not null,
    primary key(id_permissao)
);

CREATE TABLE IF NOT EXISTS permissao_usuario (
    id_permissao_usuario int auto_increment,
    permissao_id int not null,
    usuario_id int not null,
    data_registro datetime default NOW(),
    situacao enum('ativo', 'inativo') default 'ativo' not null,
    primary key(id_permissao_usuario),
    foreign key (permissao_id) references permissao(id_permissao),
    foreign key (usuario_id) references usuario(id_usuario)
);

CREATE TABLE IF NOT EXISTS tarefa (
    id_tarefa int auto_increment,
    nome_tarefa varchar(255) not null,
    descricao_tarefa text not null,
    data_registro datetime default NOW(),
    data_conclusao datetime default null,
    usuario_criacao int default null,
    usuario_alteracao int default null,
    situacao enum('concluido', 'pendente','inativo') default 'pendente' not null,
    primary key(id_tarefa),
    foreign key (usuario_criacao) references usuario(id_usuario)
);

INSERT INTO
    usuario (
        nome_usuario,
        telefone_usuario,
        email_usuario,
        senha_usuario,
        situacao
    )
VALUES
    (
        'Usuário 1',
        '35998242097',
        '1@email.com',
        '202cb962ac59075b964b07152d234b70',
        'ativo'
    ),
    (
        'Usuário 2',
        '35998242097',
        '2@email.com',
        '202cb962ac59075b964b07152d234b70',
        'ativo'
    ),
    (
        'Usuário 3',
        '35998242097',
        '3@email.com',
        '202cb962ac59075b964b07152d234b70',
        'ativo'
    ),
    (
        'Usuário 4',
        '35998242097',
        '4@email.com',
        '202cb962ac59075b964b07152d234b70',
        'inativo'
    );

INSERT INTO
    permissao (nome_permissao)
VALUES
    ('Acesso ao sistema'),
    ('Visualizar tarefas'),
    ('Cadastrar tarefa'),
    ('Editar tarefa'),
    ('Excluir tarefa'),
    ('Exportar tarefa');

INSERT INTO
    permissao_usuario (
        permissao_id,
        usuario_id
    )
VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (2, 1),
    (2, 2),
    (2, 3),
    (2, 4),
    (3, 1),
    (3, 2),
    (3, 3),
    (3, 4),
    (4, 1),
    (4, 2),
    (4, 3),
    (4, 4),
    (5, 1),
    (5, 2),
    (5, 1),
    (5, 2);