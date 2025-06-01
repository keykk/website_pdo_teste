<!-- Página Portfólio -->

<!-- Banner da página -->
<div class="page-banner bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Portfólio de Produtos</h1>
                <p class="lead">Soluções completas para todas as culturas brasileiras</p>
            </div>
        </div>
    </div>
</div>

<!-- Filtro de categorias -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <div class="category-filter-container">
                    <button class="btn btn-primary me-2 mb-2 category-filter active" data-category="all">Todos</button>
                    <?php foreach ($categories as $category): ?>
                        <button class="btn btn-outline-primary me-2 mb-2 category-filter" data-category="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Lista de produtos -->
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-6 col-lg-4 mb-4 product-item" data-category="<?php echo $product['category_id']; ?>">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo URL_ROOT . $product['image_path']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $product['name']; ?></h4>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="<?php echo URL_ROOT.'/portfolio/product/' . $product['id']; ?>" class="btn btn-primary">Ver detalhes</a>
                                <a href="#contato" class="btn btn-outline-success">Solicitar informações</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Seção de benefícios -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Por que escolher produtos Omnia?</h2>
                <p class="lead">Nossos produtos são desenvolvidos com tecnologia de ponta e foco em resultados</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box bg-primary text-white rounded-circle p-4 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-flask fa-2x"></i>
                        </div>
                        <h4>Tecnologia Avançada</h4>
                        <p>Produtos desenvolvidos com as mais avançadas tecnologias disponíveis no mercado.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box bg-primary text-white rounded-circle p-4 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-leaf fa-2x"></i>
                        </div>
                        <h4>Sustentabilidade</h4>
                        <p>Compromisso com práticas sustentáveis e respeito ao meio ambiente.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="icon-box bg-primary text-white rounded-circle p-4 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <h4>Resultados Comprovados</h4>
                        <p>Aumento de produtividade comprovado em diversas culturas brasileiras.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção de contato -->
<section class="section" id="contato">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="section-title">Solicite mais informações</h2>
                <p>Preencha o formulário abaixo para receber mais informações sobre nossos produtos. Nossa equipe entrará em contato o mais breve possível.</p>
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
                        <label for="produto" class="form-label">Produto de interesse</label>
                        <select class="form-select" id="produto">
                            <option value="" selected>Selecione um produto</option>
                            <?php foreach ($products as $product): ?>
                                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                        <h3 class="card-title mb-4">Atendimento Especializado</h3>
                        <p>A Omnia Brasil conta com uma equipe de especialistas prontos para atender às suas necessidades. Entre em contato conosco para obter mais informações sobre nossos produtos e serviços.</p>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-3"><i class="fas fa-phone me-2 text-primary"></i> (11) 1234-5678</li>
                            <li class="mb-3"><i class="fas fa-envelope me-2 text-primary"></i> comercial@omnia.com.br</li>
                            <li class="mb-3"><i class="fas fa-clock me-2 text-primary"></i> Segunda a Sexta: 8h às 18h</li>
                        </ul>
                        <hr>
                        <h4 class="mb-3">Suporte Técnico</h4>
                        <p>Nossa equipe técnica está disponível para auxiliar na aplicação e uso correto dos produtos Omnia.</p>
                        <a href="#" class="btn btn-success mt-2">
                            <i class="fab fa-whatsapp me-2"></i> Fale com um especialista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Página de detalhes do produto (será incluída em outro arquivo) -->
