<!-- Página de visualização de currículos recebidos -->

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Currículos Recebidos</h1>
    </div>

    <!-- Lista de currículos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Currículos Cadastrados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Vaga</th>
                            <th>Data</th>
                            <th width="120">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($resumes)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum currículo recebido.</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($resumes as $resume): ?>
                        <tr>
                            <td><?php echo $resume['name']; ?></td>
                            <td><?php echo $resume['email']; ?></td>
                            <td><?php echo $resume['phone']; ?></td>
                            <td><?php echo $resume['position']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($resume['date'])); ?></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#viewResumeModal<?php echo $resume['id']; ?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo $resume['file']; ?>" class="btn btn-sm btn-success btn-action" target="_blank">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteResumeModal<?php echo $resume['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modais de Visualização e Exclusão (seriam gerados dinamicamente para cada currículo) -->
<?php foreach ($resumes as $resume): ?>
<!-- Modal Visualizar Currículo -->
<div class="modal fade" id="viewResumeModal<?php echo $resume['id']; ?>" tabindex="-1" aria-labelledby="viewResumeModalLabel<?php echo $resume['id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewResumeModalLabel<?php echo $resume['id']; ?>">Detalhes do Currículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Nome:</h6>
                        <p><?php echo $resume['name']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Vaga:</h6>
                        <p><?php echo $resume['position']; ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">E-mail:</h6>
                        <p><?php echo $resume['email']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Telefone:</h6>
                        <p><?php echo $resume['phone']; ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="font-weight-bold">Data de Envio:</h6>
                        <p><?php echo date('d/m/Y H:i', strtotime($resume['date'])); ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="font-weight-bold">Arquivo:</h6>
                        <p>
                            <a href="<?php echo $resume['file']; ?>" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-file-alt me-2"></i> Visualizar Currículo
                            </a>
                            <a href="<?php echo $resume['file']; ?>" download class="btn btn-sm btn-success ms-2">
                                <i class="fas fa-download me-2"></i> Baixar Currículo
                            </a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6 class="font-weight-bold">Mensagem:</h6>
                        <div class="p-3 bg-light rounded">
                            <?php echo nl2br($resume['message'] ?? 'Nenhuma mensagem adicional.'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <a href="mailto:<?php echo $resume['email']; ?>" class="btn btn-primary">
                    <i class="fas fa-envelope me-2"></i> Enviar E-mail
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Excluir Currículo -->
<div class="modal fade" id="deleteResumeModal<?php echo $resume['id']; ?>" tabindex="-1" aria-labelledby="deleteResumeModalLabel<?php echo $resume['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteResumeModalLabel<?php echo $resume['id']; ?>">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o currículo de "<?php echo $resume['name']; ?>"?</p>
                <p class="text-danger">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="/admin/resumes/delete/<?php echo $resume['id']; ?>" class="btn btn-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
