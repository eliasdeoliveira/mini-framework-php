<?php
if ($lista !== false) {
?>
    <div id="botoes">
        <?php
        if ($permissao['cadastrar']) {
        ?>
            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTarefa">
                <i class="fa-solid fa-plus"></i> Adicionar
            </button>
        <?php
        }
        if ($permissao['cadastrar']) {
        ?>
            <button class="btn btn-primary mt-3" onclick="gerarPDF()">
                <i class="fa-solid fa-file-pdf"></i> Gerar PDF
            </button>
        <?php
        }
        ?>
    </div>
    <?php
    if ($crud !== false) {
    ?>
        <div class="p-1 px-3 mt-3 mb-0 alert alert-success alert-dismissible fade show" role="alert">
            <div class=" d-flex justify-content-between align-items-center">
                <div>
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="text-center">
                    <strong>Parabéns!</strong> Tarefa <?= $crud ?> com sucesso!
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
    <?php
    echo '<div class="row" id="lista">';
    foreach ($lista as $item) {
    ?>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <div class="p-3 shadow-sm border mt-3 rounded">
                <h3 class="text-center">
                    <?= $item['nome_tarefa'] ?> 
                </h3>
                <h6 class="text-center">
                    <?= ($item['situacao'] === 'pendente' ? '<span class="badge text-bg-warning">Pendente</span>' : '<span class="badge text-bg-success">Concluído<?pan>'); ?>
                </h6>
                <hr>
                <h6 class="text-center">
                    Data de cadastro: <?= $item['data_registro_formatado'] ?>
                </h6>
                <hr>
                <h6 class="text-center">
                    Data de conclusão: <?= ($item['data_conclusao_formatado'] === null ? '-' : $item['data_conclusao_formatado']); ?>
                </h6>
                <div class="text-center">
                    <?php
                    if ($item['situacao'] === 'pendente' && $permissao['editar']) {
                    ?>
                        <hr>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalTarefaEdicao<?= $item['id_tarefa'] ?>">
                            <i class="fa-solid fa-pencil"></i> Editar
                        </button>
                    <?php
                    }
                    if ($item['situacao'] === 'pendente' && $permissao['excluir']) {
                    ?>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalTarefaExcluir<?= $item['id_tarefa'] ?>">
                            <i class="fa-solid fa-trash"></i> Excluir
                        </button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalTarefaEdicao<?= $item['id_tarefa'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTarefaEdicaoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/tarefa/put" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTarefaEdicaoLabel">
                            <span>Edição</span> da tarefa
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="descricao_tarefa" class="form-label">
                                Nome
                            </label>
                            <input type="text" class="form-control" name="nome_tarefa" placeholder="Descrição da tarefa" value="<?= $item['nome_tarefa'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Descreva a tarefa" id="descricao_tarefa" style="min-height: 100px" name="descricao_tarefa" required><?= $item['descricao_tarefa'] ?></textarea>
                                <label for="floatingTextarea2">Descrição da tarefa</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="data_registro" class="form-label">
                                Data de criação
                            </label>
                            <input type="datetime-local" class="form-control" name="data_registro" placeholder="Data de cadastro" value="<?= $item['data_registro'] ?>" disabled required>
                        </div>
                        <?php
                        if ($item['data_conclusao']) {
                        ?>
                            <div class="mb-3">
                                <label for="data_conclusao" class="form-label">
                                    Data de conclusão
                                </label>
                                <input type="datetime-local" class="form-control" name="data_conclusao " placeholder="Data de cadastro" disabled value="<?= $item['data_conclusao'] ?>">
                            </div>
                        <?php
                        }
                        ?>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="situacao" <?= ($item['situacao'] !== 'pendente' ?? 'checked') ?>>
                            <label class="form-check-label" for="situacao">Concluído</label>
                        </div>
                        <input type="hidden" name="id_tarefa" value="<?= $item['id_tarefa'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modalTarefaExcluir<?= $item['id_tarefa'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTarefaExcluirLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTarefaExcluirLabel">
                            <span>Excluir</span> da tarefa
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Deseja excluir essa tarefa? Após excluir não será mais possível reverter!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i> Cancelar
                        </button>
                        <a href="/tarefa/excluir?id_tarefa<?= $item['id_tarefa'] ?>" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Excluir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    echo '</div>';
} else {
    ?>
    <div class="p-1 px-3 mt-2 alert alert-warning alert-dismissible fade show" role="alert">
        <div class=" d-flex justify-content-between align-items-center">
            <div>
                <strong>Ops!</strong> Não encontramos registros...
            </div>
            <div>
                <button type="button" class="btn btn-link" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa-solid fa-xmark text-dark"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="mt-2">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTarefa">
            <i class="fa-solid fa-plus"></i> Adicionar
        </button>
    </div>
<?php
}
?>
<!-- Modal -->
<div class="modal fade" id="modalTarefa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTarefaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/tarefa/store" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTarefaLabel">
                    <span>Cadastrar</span> tarefa
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="descricao_tarefa" class="form-label">
                        Nome da tarefa
                    </label>
                    <input type="text" class="form-control" name="nome_tarefa" placeholder="Descrição da tarefa" required>
                </div>
                <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Descreva a tarefa" id="descricao_tarefa" style="min-height: 100px" name="descricao_tarefa" required></textarea>
                        <label for="floatingTextarea2">Descrição da tarefa</label>
                    </div>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="situacao">
                    <label class="form-check-label" for="situacao">Concluído</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Cadastrar
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function gerarPDF() {
        const item = document.querySelector('#main');

        let opt = {
            margin: 1,
            filename: "myfile.pdf",
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: "in",
                format: "letter",
                orientation: "portrait"
            },
        };

        html2pdf().set(opt).from(item).save();
    }
</script>