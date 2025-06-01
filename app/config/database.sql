-- Criação do banco de dados Omnia
CREATE DATABASE IF NOT EXISTS omnia_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar o banco de dados
USE omnia_db;

-- Tabela de usuários administrativos
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de configurações do site
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de páginas
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(100) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de seções de conteúdo
CREATE TABLE IF NOT EXISTS content_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_id INT NOT NULL,
    section_key VARCHAR(100) NOT NULL,
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (page_id) REFERENCES pages(id) ON DELETE CASCADE,
    UNIQUE KEY unique_section (page_id, section_key)
) ENGINE=InnoDB;

-- Tabela de banners
CREATE TABLE IF NOT EXISTS banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    image_path VARCHAR(255) NOT NULL,
    link VARCHAR(255),
    active TINYINT(1) DEFAULT 1,
    order_num INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de categorias de produtos
CREATE TABLE IF NOT EXISTS product_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    active TINYINT(1) DEFAULT 1,
    order_num INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    benefits TEXT,
    image_path VARCHAR(255),
    active TINYINT(1) DEFAULT 1,
    order_num INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES product_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela de currículos recebidos
CREATE TABLE IF NOT EXISTS resumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    position VARCHAR(100),
    file_path VARCHAR(255) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de cotações
CREATE TABLE IF NOT EXISTS quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cultura VARCHAR(100) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    variacao VARCHAR(20) NOT NULL,
    tendencia ENUM('alta', 'baixa') NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de previsão do tempo
CREATE TABLE IF NOT EXISTS weather (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    temperatura VARCHAR(10) NOT NULL,
    icone VARCHAR(50) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Inserir usuário admin padrão (senha: admin123)
INSERT INTO users (username, password, email, name) VALUES 
('admin', '$2y$10$8tGIx5XCk5a.Ry0OOhJO8.V/qVT3eGxgUKGkDLF5xgxmbHf.Mbhwi', 'admin@omnia.com.br', 'Administrador')
ON DUPLICATE KEY UPDATE username = 'admin';

-- Inserir configurações padrão
INSERT INTO settings (setting_key, setting_value) VALUES 
('company_name', 'Omnia Brasil'),
('address', 'Av. Paulista, 1000 - São Paulo/SP'),
('phone', '(11) 1234-5678'),
('email', 'contato@omnia.com.br'),
('working_hours', 'Segunda a Sexta: 8h às 18h'),
('facebook', 'https://facebook.com/omniabrasil'),
('instagram', 'https://instagram.com/omniabrasil'),
('linkedin', 'https://linkedin.com/company/omniabrasil'),
('youtube', 'https://youtube.com/omniabrasil'),
('whatsapp_number', '5511123456789'),
('whatsapp_message', 'Olá, gostaria de saber mais sobre os produtos da Omnia Brasil.'),
('whatsapp_active', '1'),
('contact_email', 'contato@omnia.com.br'),
('resume_email', 'rh@omnia.com.br'),
('meta_title', 'Omnia Brasil - Soluções para Agricultura'),
('meta_keywords', 'agricultura, fertilizantes, sustentabilidade, omnia'),
('meta_description', 'A Omnia Brasil oferece soluções inovadoras e sustentáveis para a agricultura brasileira.')
ON DUPLICATE KEY UPDATE setting_key = VALUES(setting_key);

-- Inserir páginas padrão
INSERT INTO pages (slug, title, subtitle) VALUES 
('home', 'Bem-vindo à Omnia Brasil', 'Soluções sustentáveis para agricultura'),
('historia', 'Nossa História', 'Conheça a trajetória da Omnia'),
('portfolio', 'Nosso Portfólio', 'Conheça nossos produtos'),
('trabalhe-conosco', 'Trabalhe Conosco', 'Faça parte do nosso time')
ON DUPLICATE KEY UPDATE slug = VALUES(slug);

-- Obter IDs das páginas
SET @home_id = (SELECT id FROM pages WHERE slug = 'home');
SET @historia_id = (SELECT id FROM pages WHERE slug = 'historia');
SET @portfolio_id = (SELECT id FROM pages WHERE slug = 'portfolio');
SET @trabalhe_id = (SELECT id FROM pages WHERE slug = 'trabalhe-conosco');

-- Inserir seções de conteúdo para Home
INSERT INTO content_sections (page_id, section_key, title, content) VALUES 
(@home_id, 'sustainability', 'Sustentabilidade', 'A Omnia está comprometida com práticas sustentáveis que respeitam o meio ambiente e promovem o desenvolvimento responsável da agricultura brasileira.'),
(@home_id, 'values', 'Nossos Valores', 'Nossos valores incluem inovação, sustentabilidade, qualidade e compromisso com o produtor rural.'),
(@home_id, 'certificates', 'Certificados', 'ISO 9001, ISO 14001, Selo Verde, Agricultura Sustentável'),
(@home_id, 'benefits', 'Benefícios', 'Nossos produtos são desenvolvidos para todas as culturas brasileiras, garantindo maior produtividade, qualidade e rentabilidade para o produtor rural.'),
(@home_id, 'industry', 'Indústria', 'Destaque em matérias-primas e negociações B2B.')
ON DUPLICATE KEY UPDATE page_id = VALUES(page_id), section_key = VALUES(section_key);

-- Inserir seções de conteúdo para História
INSERT INTO content_sections (page_id, section_key, title, content) VALUES 
(@historia_id, 'main_content', 'História da Empresa', 'História da empresa Omnia no Brasil e no mundo.'),
(@historia_id, 'missao', 'Missão', 'Oferecer soluções inovadoras e sustentáveis para a agricultura.'),
(@historia_id, 'visao', 'Visão', 'Ser referência global em soluções para agricultura sustentável.'),
(@historia_id, 'valores', 'Valores', 'Inovação, Sustentabilidade, Qualidade, Compromisso'),
(@historia_id, 'mapa', 'Presença Global', 'A Omnia está presente em diversos países ao redor do mundo.'),
(@historia_id, 'paises', 'Países', 'Brasil, África do Sul, Austrália, EUA, Canadá')
ON DUPLICATE KEY UPDATE page_id = VALUES(page_id), section_key = VALUES(section_key);

-- Inserir seções de conteúdo para Portfólio
INSERT INTO content_sections (page_id, section_key, title, content) VALUES 
(@portfolio_id, 'benefits_section', 'Benefícios', 'Vantagens dos nossos produtos'),
(@portfolio_id, 'contact_section', 'Entre em Contato', 'Para mais informações sobre nossos produtos, entre em contato.')
ON DUPLICATE KEY UPDATE page_id = VALUES(page_id), section_key = VALUES(section_key);

-- Inserir seções de conteúdo para Trabalhe Conosco
INSERT INTO content_sections (page_id, section_key, title, content) VALUES 
(@trabalhe_id, 'description', 'Descrição', 'Estamos sempre em busca de talentos para nossa equipe.'),
(@trabalhe_id, 'beneficios', 'Benefícios', 'Plano de saúde, Vale refeição, Seguro de vida, Participação nos lucros'),
(@trabalhe_id, 'depoimentos', 'Depoimentos', 'O que nossos colaboradores dizem')
ON DUPLICATE KEY UPDATE page_id = VALUES(page_id), section_key = VALUES(section_key);

-- Inserir categorias de produtos
INSERT INTO product_categories (name, description) VALUES 
('Fertilizantes', 'Linha completa de fertilizantes para diversas culturas'),
('Condicionadores de Solo', 'Produtos para melhorar a estrutura e fertilidade do solo'),
('Defensivos Biológicos', 'Soluções biológicas para controle de pragas e doenças'),
('Nutrição Foliar', 'Produtos para aplicação foliar e complementação nutricional')
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- Obter IDs das categorias
SET @cat1_id = (SELECT id FROM product_categories WHERE name = 'Fertilizantes');
SET @cat2_id = (SELECT id FROM product_categories WHERE name = 'Condicionadores de Solo');

-- Inserir produtos
INSERT INTO products (category_id, name, description, benefits, image_path) VALUES 
(@cat1_id, 'OmniGrow', 'Fertilizante líquido de alta performance para diversas culturas.', 'Aumento de produtividade, melhor desenvolvimento radicular, maior resistência a estresses.', '/app/public/images/product1.jpg'),
(@cat2_id, 'OmniSoil', 'Condicionador de solo para melhorar a estrutura e fertilidade.', 'Melhora a estrutura do solo, aumenta a retenção de água, favorece o desenvolvimento microbiano benéfico.', '/app/public/images/product2.jpg')
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- Inserir cotações
INSERT INTO quotes (cultura, valor, variacao, tendencia) VALUES 
('Soja', 150.25, '+1.5%', 'alta'),
('Milho', 85.75, '-0.8%', 'baixa'),
('Café', 1250.00, '+2.3%', 'alta'),
('Algodão', 450.30, '+0.5%', 'alta'),
('Trigo', 95.40, '-1.2%', 'baixa')
ON DUPLICATE KEY UPDATE cultura = VALUES(cultura);

-- Inserir previsão do tempo
INSERT INTO weather (cidade, estado, temperatura, icone) VALUES 
('São Paulo', 'SP', '22°C', 'fa-sun'),
('Ribeirão Preto', 'SP', '28°C', 'fa-cloud-sun'),
('Goiânia', 'GO', '30°C', 'fa-sun'),
('Cuiabá', 'MT', '32°C', 'fa-sun'),
('Campo Grande', 'MS', '29°C', 'fa-cloud-sun')
ON DUPLICATE KEY UPDATE cidade = VALUES(cidade);
