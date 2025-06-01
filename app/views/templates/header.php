<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Omnia Brasil'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/app/public/css/style.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo URL_ROOT; ?>/app/public/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <!-- Cabeçalho -->
    <header class="sticky-top">
        <!-- Barra superior com informações de contato -->
        <div class="bg-dark text-white py-2">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <small><i class="fas fa-phone me-2"></i> (11) 1234-5678</small>
                    <small class="ms-3"><i class="fas fa-envelope me-2"></i> contato@omnia.com.br</small>
                </div>
                <div>
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Navbar principal -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo URL_ROOT; ?>/">
                    <img src="<?php echo URL_ROOT; ?>/app/public/images/logo.png" alt="Omnia Brasil" height="60">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($request == '' || $request == '/') ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($request == 'historia') ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>/historia">História</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($request == 'portfolio') ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>/portfolio">Portfólio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($request == 'trabalhe-conosco') ? 'active' : ''; ?>" href="<?php echo URL_ROOT; ?>/trabalhe-conosco">Trabalhe Conosco</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success text-white ms-lg-3 px-4" href="#contato">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Botão de WhatsApp fixo -->
    <div class="whatsapp-button">
        <a href="https://wa.me/5511123456789" target="_blank" class="btn btn-success rounded-circle">
            <i class="fab fa-whatsapp fa-2x"></i>
        </a>
    </div>
    
    <!-- Conteúdo principal -->
    <main>
