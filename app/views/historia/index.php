<!-- Página História -->

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
                        <h2 class="section-title"><?php echo $content['title']; ?></h2>
                        <div class="historia-content">
                            <?php echo nl2br($content['main_content']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Missão</h3>
                        <p><?php echo $content['missao']; ?></p>
                    </div>
                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Visão</h3>
                        <p><?php echo $content['visao']; ?></p>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Valores</h3>
                        <ul class="list-unstyled">
                            <?php foreach (explode(", ",$content['valores']) as $valor): ?>
                                <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> <?php echo $valor; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mapa de atuação -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo $content['mapa_TITLE']; ?></h2>
                <p class="lead"><?php echo $content['mapa']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Mapa mundial (imagem ou embed) -->
                        <div class="world-map text-center mb-4">
                            <img src="/public/images/world-map.jpg" alt="Mapa de atuação mundial Omnia" class="img-fluid">
                        </div>
                        
                        <!-- Lista de países -->
                        <div class="row">
                            <?php foreach (explode(", ",$content['paises']) as $pais): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <span><?php echo $pais; ?></span>
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

<!-- Linha do tempo -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Nossa Trajetória</h2>
                <p class="lead">Conheça os principais marcos da história da Omnia</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot bg-primary"></div>
                        <div class="timeline-content">
                            <h4>1953</h4>
                            <p>Fundação da Omnia na África do Sul, com foco em soluções para agricultura.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot bg-primary"></div>
                        <div class="timeline-content">
                            <h4>1970</h4>
                            <p>Expansão para outros países africanos, com abertura de unidades em Zâmbia e Moçambique.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot bg-primary"></div>
                        <div class="timeline-content">
                            <h4>1985</h4>
                            <p>Início das operações na Austrália e Nova Zelândia.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot bg-primary"></div>
                        <div class="timeline-content">
                            <h4>2000</h4>
                            <p>Expansão para a América do Norte, com abertura de unidades nos Estados Unidos e Canadá.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot bg-primary"></div>
                        <div class="timeline-content">
                            <h4>2010</h4>
                            <p>Início das operações no Brasil, trazendo soluções inovadoras para o agronegócio brasileiro.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot bg-primary"></div>
                        <div class="timeline-content">
                            <h4>2020</h4>
                            <p>Expansão das operações no Brasil, com abertura de novas unidades e ampliação do portfólio de produtos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Equipe -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Nossa Equipe</h2>
                <p class="lead">Conheça os profissionais que fazem a Omnia Brasil</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="team-member-img mb-3">
                            <img src="/public/images/team1.jpg" alt="Diretor Executivo" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h4>João Silva</h4>
                        <p class="text-muted">Diretor Executivo</p>
                        <p>Mais de 20 anos de experiência no setor agrícola, com foco em gestão e desenvolvimento de negócios.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="team-member-img mb-3">
                            <img src="/public/images/team2.jpg" alt="Diretora de Operações" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h4>Maria Oliveira</h4>
                        <p class="text-muted">Diretora de Operações</p>
                        <p>Especialista em processos industriais e gestão de operações, com foco em eficiência e sustentabilidade.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="team-member-img mb-3">
                            <img src="/public/images/team3.jpg" alt="Diretor Técnico" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h4>Carlos Santos</h4>
                        <p class="text-muted">Diretor Técnico</p>
                        <p>Doutor em Agronomia com vasta experiência em pesquisa e desenvolvimento de soluções para o agronegócio.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Estilo adicional para a linha do tempo -->
<style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 2px;
        background-color: #e9ecef;
        transform: translateX(-50%);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 50px;
    }
    
    .timeline-dot {
        position: absolute;
        left: 50%;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }
    
    .timeline-content {
        position: relative;
        width: 45%;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .timeline-item:nth-child(odd) .timeline-content {
        margin-left: auto;
    }
    
    @media (max-width: 767px) {
        .timeline:before {
            left: 20px;
        }
        
        .timeline-dot {
            left: 20px;
        }
        
        .timeline-content {
            width: calc(100% - 60px);
            margin-left: 60px !important;
        }
    }
</style>
