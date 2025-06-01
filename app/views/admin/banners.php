<!-- Página de gerenciamento de banners -->

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gerenciamento de Banners</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addBannerModal">
            <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Adicionar Banner
        </a>
    </div>

    <!-- ERRO -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
        </div>
     <?php endif; ?>
    <!-- SUCESSO -->
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i> <?php echo $success; ?>
        </div>
    <?php endif; ?> 

    <!-- Lista de banners -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Banners Ativos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="80">Imagem</th>
                            <th>Título</th>
                            <th>Link</th>
                            <th width="100">Status</th>
                            <th width="120">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banners as $banner): ?>
                        <tr>
                            <td>
                                <img src="<?php echo URL_ROOT . DIR_BANNERS . $banner['image_path']; ?>" alt="<?php echo $banner['title']; ?>" class="img-thumbnail" style="max-width: 80px;">
                            </td>
                            <td><?php echo $banner['title']; ?></td>
                            <td><?php echo $banner['link']; ?></td>
                            <td>
                                <?php if ($banner['active']): ?>
                                    <span class="badge bg-success">Ativo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inativo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#editBannerModal<?php echo $banner['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteBannerModal<?php echo $banner['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Adicionar Banner -->
<div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBannerModalLabel">Adicionar Novo Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-admin" action="<?php echo URL_ROOT; ?>/admin/banners/" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link (opcional)</label>
                        <input type="text" class="form-control" id="link" name="link">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        <div class="form-text">Tamanho recomendado: 1920x500 pixels</div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="active" name="active" checked>
                        <label class="form-check-label" for="active">Ativo</label>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modais de Edição e Exclusão (seriam gerados dinamicamente para cada banner) -->
<?php foreach ($banners as $banner): ?>
<!-- Modal Editar Banner -->
<div class="modal fade" id="editBannerModal<?php echo $banner['id']; ?>" tabindex="-1" aria-labelledby="editBannerModalLabel<?php echo $banner['id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBannerModalLabel<?php echo $banner['id']; ?>">Editar Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-admin" action="<?php echo URL_ROOT; ?>/admin/banners/" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $banner['id']; ?>">
                    <div class="mb-3">
                        <label for="title<?php echo $banner['id']; ?>" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title<?php echo $banner['id']; ?>" name="title" value="<?php echo $banner['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="link<?php echo $banner['id']; ?>" class="form-label">Link (opcional)</label>
                        <input type="text" class="form-control" id="link<?php echo $banner['id']; ?>" name="link" value="<?php echo $banner['link']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image<?php echo $banner['id']; ?>" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="image<?php echo $banner['id']; ?>" name="image" accept="image/*">
                        <div class="form-text">Deixe em branco para manter a imagem atual</div>
                        <div class="mt-2">
                            <p>Imagem atual:</p>
                            <img src="<?php echo URL_ROOT . DIR_BANNERS . $banner['image_path']; ?>" alt="<?php echo $banner['title']; ?>" class="img-preview">
                            <input type="hidden" name="existing_image" value="<?php echo $banner['image_path']; ?>">
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="active<?php echo $banner['id']; ?>" name="active" <?php echo $banner['active'] ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="active<?php echo $banner['id']; ?>">Ativo</label>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Excluir Banner -->
<div class="modal fade" id="deleteBannerModal<?php echo $banner['id']; ?>" tabindex="-1" aria-labelledby="deleteBannerModalLabel<?php echo $banner['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBannerModalLabel<?php echo $banner['id']; ?>">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o banner "<?php echo $banner['title']; ?>"?</p>
                <p class="text-danger">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="<?php echo URL_ROOT; ?>/admin/banners?delete=<?php echo $banner['id']; ?>" class="btn btn-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
