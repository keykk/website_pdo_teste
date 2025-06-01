<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Omnia Brasil - Painel Administrativo'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos do painel admin -->
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/app/public/css/admin.css">
    
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark text-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4">
                <img src="<?php echo URL_ROOT; ?>/app/public/images/logo-white.png" alt="Omnia Brasil" height="40">
                <div class="mt-2">Painel Administrativo</div>
            </div>
            <div class="list-group list-group-flush">
                <a href="<?php echo URL_ROOT; ?>/admin/dashboard" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="<?php echo URL_ROOT; ?>/admin/banners" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-images me-2"></i>Banners
                </a>
                <a href="<?php echo URL_ROOT; ?>/admin/content" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-home me-2"></i>Conteúdo Home
                </a>
                <a href="<?php echo URL_ROOT; ?>/admin/products" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-box me-2"></i>Produtos
                </a>
                <a href="<?php echo URL_ROOT; ?>/admin/resumes" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-file-alt me-2"></i>Currículos
                </a>
                <a href="<?php echo URL_ROOT; ?>/admin/settings" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-cog me-2"></i>Configurações
                </a>
                <a href="<?php echo URL_ROOT; ?>/admin/logout" class="list-group-item list-group-item-action bg-transparent text-white mt-5">
                    <i class="fas fa-sign-out-alt me-2"></i>Sair
                </a>
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-dark" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ms-auto d-flex">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i><?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Admin'; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?php echo URL_ROOT; ?>/admin/settings"><i class="fas fa-cog me-2"></i>Configurações</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo URL_ROOT; ?>/admin/logout"><i class="fas fa-sign-out-alt me-2"></i>Sair</a></li>
                            </ul>
                        </div>
                        <a href="<?php echo URL_ROOT; ?>/" class="nav-link ms-3" target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i>Ver Site
                        </a>
                    </div>
                </div>
            </nav>
            
            <!-- Conteúdo da página -->
            <div class="container-fluid p-4">
