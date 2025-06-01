<!-- Página de gerenciamento de produtos -->

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gerenciamento de Produtos</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Adicionar Produto
        </a>
    </div>

    <!-- Filtro de categorias -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filtrar por Categoria</h6>
        </div>
        <div class="card-body">
            <div class="btn-group mb-3">
                <button type="button" class="btn btn-primary active" data-category="all">Todos</button>
                <?php foreach ($categories as $category): ?>
                    <button type="button" class="btn btn-outline-primary" data-category="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Lista de produtos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Produtos Cadastrados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="80">Imagem</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th width="100">Status</th>
                            <th width="120">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr data-category="<?php echo $product['category_id']; ?>">
                            <td>
                                <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>" class="img-thumbnail" style="max-width: 80px;">
                            </td>
                            <td><?php echo $product['name']; ?></td>
                            <td>
                                <?php 
                                foreach ($categories as $category) {
                                    if ($category['id'] == $product['category_id']) {
                                        echo $category['name'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo substr($product['description'], 0, 100) . '...'; ?></td>
                            <td>
                                <?php if ($product['active']): ?>
                                    <span class="badge bg-success">Ativo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inativo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteProductModal<?php echo $product['id']; ?>">
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

<!-- Modal Adicionar Produto -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Adicionar Novo Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-admin" action="/admin/products/add" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" selected disabled>Selecione uma categoria</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição Curta</label>
                        <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="benefits" class="form-label">Benefícios</label>
                        <textarea class="form-control" id="benefits" name="benefits" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagem Principal</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
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

<!-- Modais de Edição e Exclusão (seriam gerados dinamicamente para cada produto) -->
<?php foreach ($products as $product): ?>
<!-- Modal Editar Produto -->
<div class="modal fade" id="editProductModal<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel<?php echo $product['id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel<?php echo $product['id']; ?>">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-admin" action="/admin/products/edit/<?php echo $product['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name<?php echo $product['id']; ?>" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="name<?php echo $product['id']; ?>" name="name" value="<?php echo $product['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id<?php echo $product['id']; ?>" class="form-label">Categoria</label>
                        <select class="form-select" id="category_id<?php echo $product['id']; ?>" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description<?php echo $product['id']; ?>" class="form-label">Descrição Curta</label>
                        <textarea class="form-control" id="description<?php echo $product['id']; ?>" name="description" rows="2" required><?php echo $product['description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="benefits<?php echo $product['id']; ?>" class="form-label">Benefícios</label>
                        <textarea class="form-control" id="benefits<?php echo $product['id']; ?>" name="benefits" rows="2" required><?php echo $product['benefits']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image<?php echo $product['id']; ?>" class="form-label">Imagem Principal</label>
                        <input type="file" class="form-control" id="image<?php echo $product['id']; ?>" name="image" accept="image/*">
                        <div class="form-text">Deixe em branco para manter a imagem atual</div>
                        <div class="mt-2">
                            <p>Imagem atual:</p>
                            <img src="<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>" class="img-preview">
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="active<?php echo $product['id']; ?>" name="active" <?php echo $product['active'] ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="active<?php echo $product['id']; ?>">Ativo</label>
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

<!-- Modal Excluir Produto -->
<div class="modal fade" id="deleteProductModal<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="deleteProductModalLabel<?php echo $product['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel<?php echo $product['id']; ?>">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir o produto "<?php echo $product['name']; ?>"?</p>
                <p class="text-danger">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="/admin/products/delete/<?php echo $product['id']; ?>" class="btn btn-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Script para filtrar produtos por categoria -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.btn-group button');
        const productRows = document.querySelectorAll('tbody tr');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover classe active de todos os botões
                filterButtons.forEach(btn => btn.classList.remove('active', 'btn-primary'));
                filterButtons.forEach(btn => btn.classList.add('btn-outline-primary'));
                
                // Adicionar classe active ao botão clicado
                this.classList.remove('btn-outline-primary');
                this.classList.add('active', 'btn-primary');
                
                const category = this.getAttribute('data-category');
                
                // Filtrar produtos
                productRows.forEach(row => {
                    if (category === 'all' || row.getAttribute('data-category') === category) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
