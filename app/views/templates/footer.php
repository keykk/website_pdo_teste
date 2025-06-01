    </main>
    
    <?php
    // Carregar e renderizar o rodapé dinâmico
    require_once __DIR__ . '/../../components/FooterWidget.php';
    $footerWidget = new FooterWidget();
    
    // Renderizar rodapé com cotações e previsão do tempo
    echo $footerWidget->renderCotacoesPrevisao();
    
    // Renderizar rodapé principal com informações de contato
    echo $footerWidget->renderRodapePrincipal();
    ?>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script src="<?php echo URL_ROOT; ?>/app/public/js/main.js"></script>
</body>
</html>
