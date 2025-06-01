<!-- Página inicial (Home) -->

<!-- Banner/Carousel -->
<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($banners as $key => $banner): ?>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="<?php echo $key; ?>" <?php echo $key === 0 ? 'class="active"' : ''; ?> aria-current="<?php echo $key === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $key + 1; ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($banners as $key => $banner): ?>
            <div class="carousel-item <?php echo $key === 0 ? 'active' : ''; ?>" style="background-image: url('<?php echo URL_ROOT . DIR_BANNERS . $banner['image_path']; ?>')">
                <div class="carousel-caption d-none d-md-block">
                    <h2><?php echo $banner['title']; ?></h2>
                    <?php if (!empty($banner['link'])): ?>
                        <a target="_blanck" href="<?php echo $banner['link']; ?>" class="btn btn-primary mt-3">Saiba mais</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Próximo</span>
    </button>
</div>

<!-- Seção de Sustentabilidade e Valores -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title">Sustentabilidade e Valores</h2>
                <p class="lead"><?php echo $info['sustainability']; ?></p>
                <p><?php echo $info['values']; ?></p>
                <p><?php echo $info['industry']; ?></p>
                <a href="/historia" class="btn btn-outline-primary">Conheça nossa história</a>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Certificados e Selos</h3>
                        <div class="row">
                            <?php foreach (explode(", ",$info['certificates']) as $certificado): ?>
                                <div class="col-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-primary text-white rounded-circle p-3 me-3">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                        <div><?php echo $certificado; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção de Benefícios -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Benefícios Omnia</h2>
                <p class="lead"><?php echo $info['benefits']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box bg-primary text-white rounded-circle p-4 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-leaf fa-2x"></i>
                        </div>
                        <h4>Sustentabilidade</h4>
                        <p>Produtos desenvolvidos com foco na sustentabilidade e respeito ao meio ambiente.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box bg-primary text-white rounded-circle p-4 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-flask fa-2x"></i>
                        </div>
                        <h4>Inovação</h4>
                        <p>Tecnologia de ponta aplicada ao desenvolvimento de soluções para o agronegócio.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box bg-primary text-white rounded-circle p-4 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-seedling fa-2x"></i>
                        </div>
                        <h4>Produtividade</h4>
                        <p>Aumento comprovado de produtividade em diversas culturas brasileiras.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção de Indústria -->
<section class="section bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="/public/images/industria.jpg" alt="Indústria Omnia" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Indústria Omnia</h2>
                <p class="lead">Excelência em matérias-primas e negociações B2B</p>
                <p>A Omnia Brasil conta com uma moderna planta industrial, equipada com tecnologia de ponta para garantir a produção de produtos de alta qualidade. Nossa indústria segue rigorosos padrões de qualidade e sustentabilidade, garantindo a excelência em todas as etapas do processo produtivo.</p>
                <p>Oferecemos soluções personalizadas para negociações B2B, atendendo às necessidades específicas de cada parceiro comercial. Nossa equipe de especialistas está pronta para desenvolver produtos sob medida para sua empresa.</p>
                <a href="/portfolio" class="btn btn-primary mt-3">Conheça nosso portfólio</a>
            </div>
        </div>
    </div>
</section>

<!-- Seção de Contato -->
<section class="section" id="contato">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title">Entre em Contato</h2>
                <p>Preencha o formulário abaixo para entrar em contato com nossa equipe. Teremos prazer em responder suas dúvidas e fornecer mais informações sobre nossos produtos e serviços.</p>
                <form id="contactForm" class="mt-4">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone">
                    </div>
                    <div class="mb-3">
                        <label for="assunto" class="form-label">Assunto</label>
                        <input type="text" class="form-control" id="assunto" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="mensagem" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Informações de Contato</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Av. Paulista, 1000 - São Paulo/SP</li>
                            <li class="mb-3"><i class="fas fa-phone me-2 text-primary"></i> (11) 1234-5678</li>
                            <li class="mb-3"><i class="fas fa-envelope me-2 text-primary"></i> contato@omnia.com.br</li>
                            <li class="mb-3"><i class="fas fa-clock me-2 text-primary"></i> Segunda a Sexta: 8h às 18h</li>
                        </ul>
                        <hr>
                        <h4 class="mb-3">Siga-nos nas Redes Sociais</h4>
                        <div class="social-links">
                            <a href="#" class="me-3"><i class="fab fa-facebook fa-2x text-primary"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-instagram fa-2x text-primary"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-linkedin fa-2x text-primary"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-youtube fa-2x text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
