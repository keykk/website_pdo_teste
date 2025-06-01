<?php
/**
 * Componente para exibir o rodapé com cotações e previsão do tempo
 */
class FooterWidget {
    private $settingsModel,
            $footerDataModel;
    
    /**
     * Construtor
     */
    public function __construct() {
        require_once __DIR__ . '/../models/SettingsModel.php';
        $this->settingsModel = new SettingsModel();
        $this->footerDataModel = new FooterDataModel();
    }
    
    /**
     * Renderizar o rodapé com cotações e previsão do tempo
     */
    public function renderCotacoesPrevisao() {
        $cotacoes = $this->footerDataModel->getAllQuotes();
        $previsao = $this->footerDataModel->getAllWeather();
        
        ob_start();
        ?>
        <!-- Rodapé com cotações e previsão do tempo -->
        <footer class="bg-light py-3 border-top mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Cotações</h5>
                        <div class="cotacoes-container">
                            <?php foreach ($cotacoes as $cotacao): ?>
                                <?php $tendenciaClass = $cotacao['tendencia'] === 'alta' ? 'text-success' : 'text-danger'; ?>
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                    <span><?php echo $cotacao['cultura']; ?></span>
                                    <span class="<?php echo $tendenciaClass; ?>"><?php echo $cotacao['valor']; ?> (<?php echo $cotacao['variacao']; ?>)</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Previsão do Tempo</h5>
                        <div class="previsao-container">
                            <?php foreach ($previsao as $cidade): ?>
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                    <span><?php echo $cidade['cidade']; ?>/<?php echo $cidade['estado']; ?></span>
                                    <div>
                                        <i class="fas <?php echo $cidade['icone']; ?> text-warning me-2"></i>
                                        <span><?php echo $cidade['temperatura']; ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Renderizar o rodapé principal com informações de contato
     */
    public function renderRodapePrincipal() {
        $settings = $this->settingsModel->getAllSettings();
        
        ob_start();
        ?>
        <!-- Rodapé principal -->
        <footer class="bg-dark text-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <img src="<?php echo URL_ROOT; ?>/app/public/images/logo-white.png" alt="<?php echo $settings['company_name']; ?>" class="mb-4" height="60">
                        <p>Soluções inovadoras e sustentáveis para a agricultura brasileira. Compromisso com a qualidade e o desenvolvimento do agronegócio.</p>
                        <div class="mt-4">
                            <a href="<?php echo $settings['facebook']; ?>" class="text-white me-3" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="<?php echo $settings['instagram']; ?>" class="text-white me-3" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="<?php echo $settings['linkedin']; ?>" class="text-white me-3" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
                            <a href="<?php echo $settings['youtube']; ?>" class="text-white" target="_blank"><i class="fab fa-youtube fa-lg"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h5 class="mb-4">Contato</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3"><i class="fas fa-map-marker-alt me-2"></i> <?php echo $settings['address']; ?></li>
                            <li class="mb-3"><i class="fas fa-phone me-2"></i> <?php echo $settings['phone']; ?></li>
                            <li class="mb-3"><i class="fas fa-envelope me-2"></i> <?php echo $settings['email']; ?></li>
                            <li><i class="fas fa-clock me-2"></i> <?php echo $settings['working_hours']; ?></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-4">Links Rápidos</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="<?php echo URL_ROOT; ?>/" class="text-white text-decoration-none">Home</a></li>
                            <li class="mb-2"><a href="<?php echo URL_ROOT; ?>/historia" class="text-white text-decoration-none">História</a></li>
                            <li class="mb-2"><a href="<?php echo URL_ROOT; ?>/portfolio" class="text-white text-decoration-none">Portfólio</a></li>
                            <li class="mb-2"><a href="<?php echo URL_ROOT; ?>/trabalhe-conosco" class="text-white text-decoration-none">Trabalhe Conosco</a></li>
                            <li><a href="#contato" class="text-white text-decoration-none">Contato</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        
        <!-- Copyright -->
        <div class="bg-black text-white py-3">
            <div class="container text-center">
                <small>&copy; <?php echo date('Y'); ?> <?php echo $settings['company_name']; ?>. Todos os direitos reservados.</small>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
