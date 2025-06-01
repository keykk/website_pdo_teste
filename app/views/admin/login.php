<!-- Página de login do painel administrativo -->

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="/public/images/logo.png" alt="Omnia Brasil" height="60" class="mb-3">
                        <h2>Painel Administrativo</h2>
                        <p class="text-muted">Faça login para acessar o painel</p>
                    </div>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post" action="<?php echo URL_ROOT ?>/admin">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuário</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Senha</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <a href="/" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i> Voltar para o site
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
