/* Scripts personalizados para o site Omnia */

// Função para inicializar o carrossel de banners
function initBannerCarousel() {
    const bannerCarousel = document.getElementById('bannerCarousel');
    if (bannerCarousel) {
        const carousel = new bootstrap.Carousel(bannerCarousel, {
            interval: 5000,
            wrap: true
        });
    }
}

// Função para inicializar o formulário de contato
function initContactForm() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulação de envio de formulário
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...';
            
            // Simulação de delay de envio
            setTimeout(() => {
                // Exibir mensagem de sucesso
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success mt-3';
                alertDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i> Mensagem enviada com sucesso! Entraremos em contato em breve.';
                
                contactForm.appendChild(alertDiv);
                
                // Limpar formulário
                contactForm.reset();
                
                // Restaurar botão
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
                
                // Remover alerta após 5 segundos
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }, 1500);
        });
    }
}

// Função para inicializar o formulário de currículo
function initResumeForm() {
    const resumeForm = document.getElementById('resumeForm');
    if (resumeForm) {
        resumeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validação básica
            let isValid = true;
            const requiredFields = this.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                return;
            }
            
            // Simulação de envio de formulário
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enviando...';
            
            // Simulação de delay de envio
            setTimeout(() => {
                // Exibir mensagem de sucesso
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success mt-3';
                alertDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i> Currículo enviado com sucesso! Entraremos em contato em breve.';
                
                resumeForm.appendChild(alertDiv);
                
                // Limpar formulário
                resumeForm.reset();
                
                // Restaurar botão
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
                
                // Remover alerta após 5 segundos
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }, 1500);
        });
    }
}

// Função para inicializar filtro de produtos
function initProductFilter() {
    const categoryButtons = document.querySelectorAll('.category-filter');
    const productItems = document.querySelectorAll('.product-item');
    
    if (categoryButtons.length && productItems.length) {
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover classe ativa de todos os botões
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                
                // Adicionar classe ativa ao botão clicado
                this.classList.add('active');
                
                const category = this.getAttribute('data-category');
                
                // Filtrar produtos
                productItems.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }
}

// Função para inicializar animações de scroll
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    if (animatedElements.length) {
        // Função para verificar se elemento está visível na viewport
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.8
            );
        }
        
        // Função para animar elementos visíveis
        function animateVisibleElements() {
            animatedElements.forEach(element => {
                if (isElementInViewport(element) && !element.classList.contains('animated')) {
                    element.classList.add('animated', 'fade-in');
                }
            });
        }
        
        // Verificar elementos visíveis no carregamento da página
        animateVisibleElements();
        
        // Verificar elementos visíveis durante o scroll
        window.addEventListener('scroll', animateVisibleElements);
    }
}

// Inicializar todas as funções quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    initBannerCarousel();
    initContactForm();
    initResumeForm();
    initProductFilter();
    initScrollAnimations();
});
