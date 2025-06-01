<!-- Página Trabalhe Conosco -->

<!-- Banner da página -->
<div class="page-banner bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1><?php echo $content['title']; ?></h1>
                <p class="lead"><?php echo $content['subtitle']; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Conteúdo principal -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="section-title">Trabalhe Conosco</h2>
                        <div class="trabalhe-content">
                            <?php echo nl2br($content['description']); ?>
                        </div>
                        
                        <!-- Benefícios -->
                        <h3 class="mt-4 mb-3">Benefícios</h3>
                        <div class="row">
                            <?php foreach (explode(", ",$content['beneficios']) as $beneficio): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-primary me-2"></i>
                                        <span><?php echo $beneficio; ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Envie seu currículo</h3>
                        <p>Preencha o formulário abaixo para enviar seu currículo e fazer parte do nosso banco de talentos.</p>
                        
                        <!-- Exibir mensagens de erro -->
                        <?php if (isset($_SESSION['form_errors'])): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($_SESSION['form_errors'] as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php unset($_SESSION['form_errors']); ?>
                        <?php endif; ?>
                        
                        <!-- Exibir mensagem de sucesso -->
                        <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success_message']; ?>
                            </div>
                            <?php unset($_SESSION['success_message']); ?>
                        <?php endif; ?>
                        
                        <form id="resumeForm" action="/trabalhe-conosco/enviar-curriculo" method="post" enctype="multipart/form-data" class="mt-4">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo isset($_SESSION['form_data']['nome']) ? $_SESSION['form_data']['nome'] : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" required value="<?php echo isset($_SESSION['form_data']['telefone']) ? $_SESSION['form_data']['telefone'] : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="vaga" class="form-label">Vaga de interesse</label>
                                <select class="form-select" id="vaga" name="vaga">
                                    <option value="" selected>Selecione uma vaga</option>
                                    <?php foreach ($vagas as $vaga): ?>
                                        <option value="<?php echo $vaga['id']; ?>" <?php echo (isset($_SESSION['form_data']['vaga']) && $_SESSION['form_data']['vaga'] == $vaga['id']) ? 'selected' : ''; ?>><?php echo $vaga['titulo']; ?></option>
                                    <?php endforeach; ?>
                                    <option value="banco_talentos" <?php echo (isset($_SESSION['form_data']['vaga']) && $_SESSION['form_data']['vaga'] == 'banco_talentos') ? 'selected' : ''; ?>>Banco de Talentos</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mensagem" class="form-label">Mensagem (opcional)</label>
                                <textarea class="form-control" id="mensagem" name="mensagem" rows="3"><?php echo isset($_SESSION['form_data']['mensagem']) ? $_SESSION['form_data']['mensagem'] : ''; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="curriculo" class="form-label">Currículo (PDF ou Word)</label>
                                <input type="file" class="form-control" id="curriculo" name="curriculo" accept=".pdf,.doc,.docx" required>
                                <div class="form-text">Tamanho máximo: 5MB</div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar Currículo</button>
                        </form>
                        
                        <?php unset($_SESSION['form_data']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vagas disponíveis -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Vagas Disponíveis</h2>
                <p class="lead">Confira nossas oportunidades de trabalho</p>
            </div>
        </div>
        
        <?php if (empty($vagas)): ?>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        No momento não há vagas disponíveis. Envie seu currículo para nosso banco de talentos.
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($vagas as $vaga): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0"><?php echo $vaga['titulo']; ?></h4>
                                    <span class="badge bg-primary"><?php echo $vaga['tipo']; ?></span>
                                </div>
                                <p class="text-muted mb-3"><i class="fas fa-map-marker-alt me-2"></i><?php echo $vaga['local']; ?></p>
                                <p><?php echo $vaga['descricao']; ?></p>
                                
                                <h5 class="mt-3 mb-2">Requisitos:</h5>
                                <ul>
                                    <?php foreach ($vaga['requisitos'] as $requisito): ?>
                                        <li><?php echo $requisito; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <small class="text-muted">Publicada em: <?php echo date('d/m/Y', strtotime($vaga['data_publicacao'])); ?></small>
                                    <a href="#resumeForm" class="btn btn-outline-primary">Candidatar-se</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Depoimentos -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Depoimentos</h2>
                <p class="lead">Conheça a experiência de quem faz parte do nosso time</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        </div>
                        <p class="card-text">Trabalhar na Omnia tem sido uma experiência incrível. A empresa valoriza seus colaboradores e oferece oportunidades de crescimento profissional.</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="/public/images/testimonial1.jpg" alt="Depoimento" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h5 class="mb-0">Ana Paula</h5>
                                <p class="text-muted mb-0">Engenheira Agrônoma</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        </div>
                        <p class="card-text">O ambiente de trabalho na Omnia é colaborativo e dinâmico. A empresa investe em inovação e está sempre buscando novas soluções para o agronegócio.</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="/public/images/testimonial2.jpg" alt="Depoimento" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h5 class="mb-0">Pedro Henrique</h5>
                                <p class="text-muted mb-0">Gerente de Produção</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-quote-left fa-2x text-primary opacity-25"></i>
                        </div>
                        <p class="card-text">Estou na Omnia há 5 anos e posso dizer que é uma empresa que realmente se preocupa com seus colaboradores e com o impacto de suas ações no meio ambiente.</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="/public/images/testimonial3.jpg" alt="Depoimento" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h5 class="mb-0">Juliana Costa</h5>
                                <p class="text-muted mb-0">Analista de Marketing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
