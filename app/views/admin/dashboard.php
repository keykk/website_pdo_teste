<!-- Página de dashboard do painel administrativo -->

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="/" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-external-link-alt fa-sm text-white-50 me-1"></i> Ver site
        </a>
    </div>

    <!-- Cards de estatísticas -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Produtos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Banners</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Vagas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Currículos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Conteúdo principal -->
    <div class="row">
        <!-- Atividades recentes -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Atividades Recentes</h6>
                </div>
                <div class="card-body">
                    <div class="activity-item d-flex align-items-center mb-3">
                        <div class="activity-icon bg-primary text-white rounded-circle p-2 me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="mb-0">Novo currículo recebido: Maria Oliveira</p>
                            <small class="text-muted">Hoje, 10:30</small>
                        </div>
                    </div>
                    <div class="activity-item d-flex align-items-center mb-3">
                        <div class="activity-icon bg-success text-white rounded-circle p-2 me-3">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div>
                            <p class="mb-0">Conteúdo da página Home atualizado</p>
                            <small class="text-muted">Ontem, 15:45</small>
                        </div>
                    </div>
                    <div class="activity-item d-flex align-items-center mb-3">
                        <div class="activity-icon bg-info text-white rounded-circle p-2 me-3">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <p class="mb-0">Novo produto adicionado: OmniLeaf</p>
                            <small class="text-muted">22/05/2023, 09:15</small>
                        </div>
                    </div>
                    <div class="activity-item d-flex align-items-center">
                        <div class="activity-icon bg-warning text-white rounded-circle p-2 me-3">
                            <i class="fas fa-image"></i>
                        </div>
                        <div>
                            <p class="mb-0">Banner principal atualizado</p>
                            <small class="text-muted">20/05/2023, 14:20</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ações rápidas -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ações Rápidas</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="/admin/banners" class="btn btn-primary btn-block d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-images me-2"></i> Gerenciar Banners
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="/admin/home-content" class="btn btn-success btn-block d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-home me-2"></i> Editar Home
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="/admin/products" class="btn btn-info btn-block d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-box me-2"></i> Gerenciar Produtos
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="/admin/resumes" class="btn btn-warning btn-block d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-file-alt me-2"></i> Ver Currículos
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cotações -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cotações Atuais</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Cultura</th>
                                    <th>Valor</th>
                                    <th>Variação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Soja</td>
                                    <td>R$ 150,25</td>
                                    <td class="text-success">+1,2%</td>
                                </tr>
                                <tr>
                                    <td>Milho</td>
                                    <td>R$ 75,40</td>
                                    <td class="text-success">+0,8%</td>
                                </tr>
                                <tr>
                                    <td>Café</td>
                                    <td>R$ 1.250,80</td>
                                    <td class="text-danger">-0,5%</td>
                                </tr>
                                <tr>
                                    <td>Algodão</td>
                                    <td>R$ 380,15</td>
                                    <td class="text-success">+1,5%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
