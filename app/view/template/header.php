<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu Framework</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <?php
    if (!empty($dependenciasJS)) {
        foreach ($dependenciasJS as $item) {
            echo "<script src=\"{$item}\"></script>";
        }
    }
    ?>
</head>

<style>
    body {
        background-color: #ECF0F1;
    }

    .hv-100 {
        min-height: 100vh;
    }

    .telaLogin {
        height: 100vh;
    }

    .menuLateral {
        list-style: none;
        text-decoration: none;
        padding: 0;
        margin: 0;
    }

    .none {
        display: none !important;
    }

    .btn-redondo {
        border-radius: 120%;
        padding: 2px 8px;
    }
</style>

<body>
    <div class="row telaLogin m-0 p-0 none" id="app">
        <section class="col-sm-12 col-lg-4 col-xl-3 bg-dark text-white m-0" id="barraLateralEsqueda">
            <header class="pt-2">
                <div class="text-end">
                    <buttom class="btn btn-danger btn-sm btn-redondo" onclick="manipularBarraLateralEsquerda()">
                        <i class="fa-solid fa-xmark"></i>
                    </buttom>
                </div>
                <span class="d-block display-4 text-center">
                    <i class="fa-solid fa-user"></i>
                </span>
                <h1 class="text-center">
                    <?= $_SESSION['autenticacao']['usuario']['nome_usuario'] ?>
                </h1>
                <hr />
            </header>
            <nav>
                <ul class="menuLateral">
                    <li class="py-2">
                        <a href="/" class="btn btn-light w-100">
                            <i class="fa-solid fa-house"></i> Inicio
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="/tarefas" class="btn btn-light w-100">
                            <i class="fa-solid fa-list-check"></i> Tarefas
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="#" class="btn btn-light w-100">
                            <i class="fa-solid fa-user-check"></i> Permissões
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="#" class="btn btn-light w-100">
                            <i class="fa-solid fa-gear"></i> Configurações
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="/login/sair" class="btn btn-light w-100">
                            <i class="fa-solid fa-xmark"></i> Sair
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
        <section class="col-sm-12 col-lg-8 col-xl-9 m-0 p-0" id="main">
            <div class="container-fluid bg-white hv-100 pb-3">
                <div class="d-flex justify-content-center align-items-center justify-items-center align-content-centershadow-sm rounded bg-dark text-white mt-2 p-2">
                    <div class="" id="exibirBotaoAtivarLateralEsquerda">
                        <buttom class="btn btn-light btn-sm" onclick="manipularBarraLateralEsquerda()">
                            <i class="fa-solid fa-bars"></i>
                        </buttom>
                    </div>
                    <div class="flex-grow-1">
                        <header class="px-2">
                            <h5 class=""><?= ($titulo) ?></h5>
                        </header>
                    </div>
                    <div>

                    </div>
                </div>