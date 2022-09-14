<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<style>
    .telaLogin {
        display: flex;
        height: 100vh;
        justify-content: center;
        justify-items: center;
        align-items: center;
        align-items: center;
    }
</style>

<body class="bg-light">
    <div class="container-sm">
        <div class="row telaLogin">
            <section class="col-sm-12 col-lg-8 col-xl-6 m-0">
                <div class="bg-white shadow-sm p-3 py-4 rounded">
                    <?php
                    if (!empty($erro)) {
                    ?>
                        <div class="p-1 px-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">
                            <div class="text-center d-flex justify-content-between align-items-center">
                                <div class="text-center">
                                    <strong>Ops!</strong> Dados inválidos...
                                </div>
                                <div>
                                    <button type="button" class="btn btn-link" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa-solid fa-xmark text-dark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <h1 class="display-4 text-center">
                        <i class="fa-solid fa-user-lock"></i> Login
                    </h1>
                    <form method="post" action="<?= base_url ?>/login/validacao">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-right-to-bracket"></i> Entrar
                        </button>
                    </form>
                </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>