-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2025 às 03:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `omnia_db`
--
CREATE DATABASE IF NOT EXISTS `omnia_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `omnia_db`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `order_num` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image_path`, `link`, `active`, `order_num`, `created_at`, `updated_at`) VALUES
(1, 'Flores tst', '', 'banner_683b913549fc5.webp', '', 1, 0, '2025-05-31 20:35:26', '2025-06-01 04:29:29'),
(2, 'Teste 2', '', 'banner_683b914e8e71f.webp', '', 1, 0, '2025-05-31 21:05:12', '2025-05-31 23:31:26'),
(20, 'Fatality', '', 'banner_683bd98407622.png', '', 1, 0, '2025-06-01 04:39:32', '2025-06-01 04:39:32'),
(21, 'teste', '', 'banner_683bddc983807.webp', '', 0, 0, '2025-06-01 04:57:45', '2025-06-01 04:57:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `content_sections`
--

CREATE TABLE `content_sections` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `section_key` varchar(100) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `content_sections`
--

INSERT INTO `content_sections` (`id`, `page_id`, `section_key`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'sustainability', 'Sustentabilidade', 'A Omnia está comprometida com práticas sustentáveis que respeitam o meio ambiente e promovem o desenvolvimento responsável da agricultura brasileira.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(2, 1, 'values', 'Nossos Valores', 'Nossos valores incluem inovação, sustentabilidade, qualidade e compromisso com o produtor rural.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(3, 1, 'certificates', 'Certificados', 'ISO 9001, ISO 14001, Selo Verde, Agricultura Sustentável', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(4, 1, 'benefits', 'Benefícios', 'Nossos produtos são desenvolvidos para todas as culturas brasileiras, garantindo maior produtividade, qualidade e rentabilidade para o produtor rural.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(5, 1, 'industry', 'Indústria', 'Destaque em matérias-primas e negociações B2B.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(6, 2, 'main_content', 'História da Empresa', 'História da empresa Omnia no Brasil e no mundo.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(7, 2, 'missao', 'Missão', 'Oferecer soluções inovadoras e sustentáveis para a agricultura.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(8, 2, 'visao', 'Visão', 'Ser referência global em soluções para agricultura sustentável.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(9, 2, 'valores', 'Valores', 'Inovação, Sustentabilidade, Qualidade, Compromisso', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(10, 2, 'mapa', 'Presença Global', 'A Omnia está presente em diversos países ao redor do mundo.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(11, 2, 'paises', 'Países', 'Brasil, África do Sul, Austrália, EUA, Canadá', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(12, 3, 'benefits_section', 'Benefícios', 'Vantagens dos nossos produtos', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(13, 3, 'contact_section', 'Entre em Contato', 'Para mais informações sobre nossos produtos, entre em contato.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(14, 4, 'description', 'Descrição', 'Estamos sempre em busca de talentos para nossa equipe.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(15, 4, 'beneficios', 'Benefícios', 'Plano de saúde, Vale refeição, Seguro de vida, Participação nos lucros', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(16, 4, 'depoimentos', 'Depoimentos', 'O que nossos colaboradores dizem', '2025-05-31 13:56:56', '2025-05-31 13:56:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `subtitle`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Bem-vindo à Omnia Brasil', 'Soluções sustentáveis para agricultura', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(2, 'historia', 'Nossa História', 'Conheça a trajetória da Omnia', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(3, 'portfolio', 'Nosso Portfólio', 'Conheça nossos produtos', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(4, 'trabalhe-conosco', 'Trabalhe Conosco', 'Faça parte do nosso time', '2025-05-31 13:56:56', '2025-05-31 13:56:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `order_num` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `benefits`, `image_path`, `active`, `order_num`, `created_at`, `updated_at`) VALUES
(1, 1, 'OmniGrow', 'Fertilizante líquido de alta performance para diversas culturas.', 'Aumento de produtividade, melhor desenvolvimento radicular, maior resistência a estresses.', '/app/public/images/product1.jpg', 1, 0, '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(2, 2, 'OmniSoil', 'Condicionador de solo para melhorar a estrutura e fertilidade.', 'Melhora a estrutura do solo, aumenta a retenção de água, favorece o desenvolvimento microbiano benéfico.', '/app/public/images/product2.jpg', 1, 0, '2025-05-31 13:56:56', '2025-05-31 13:56:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `order_num` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `active`, `order_num`, `created_at`, `updated_at`) VALUES
(1, 'Fertilizantes', 'Linha completa de fertilizantes para diversas culturas', 1, 0, '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(2, 'Condicionadores de Solo', 'Produtos para melhorar a estrutura e fertilidade do solo', 1, 0, '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(3, 'Defensivos Biológicos', 'Soluções biológicas para controle de pragas e doenças', 1, 0, '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(4, 'Nutrição Foliar', 'Produtos para aplicação foliar e complementação nutricional', 1, 0, '2025-05-31 13:56:56', '2025-05-31 13:56:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `cultura` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `variacao` varchar(20) NOT NULL,
  `tendencia` enum('alta','baixa') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `quotes`
--

INSERT INTO `quotes` (`id`, `cultura`, `valor`, `variacao`, `tendencia`, `updated_at`) VALUES
(1, 'Soja', 150.25, '+1.5%', 'alta', '2025-05-31 13:56:56'),
(2, 'Milho', 85.75, '-0.8%', 'baixa', '2025-05-31 13:56:56'),
(3, 'Café', 1250.00, '+2.3%', 'alta', '2025-05-31 13:56:56'),
(4, 'Algodão', 450.30, '+0.5%', 'alta', '2025-05-31 13:56:56'),
(5, 'Trigo', 95.40, '-1.2%', 'baixa', '2025-05-31 13:56:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'Omnia Brasil', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(2, 'address', 'Av. Paulista, 1000 - São Paulo/SP', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(3, 'phone', '(11) 1234-5678', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(4, 'email', 'contato@omnia.com.br', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(5, 'working_hours', 'Segunda a Sexta: 8h às 18h', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(6, 'facebook', 'https://facebook.com/omniabrasil', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(7, 'instagram', 'https://instagram.com/omniabrasil', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(8, 'linkedin', 'https://linkedin.com/company/omniabrasil', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(9, 'youtube', 'https://youtube.com/omniabrasil', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(10, 'whatsapp_number', '5511123456789', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(11, 'whatsapp_message', 'Olá, gostaria de saber mais sobre os produtos da Omnia Brasil.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(12, 'whatsapp_active', '1', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(13, 'contact_email', 'contato@omnia.com.br', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(14, 'resume_email', 'rh@omnia.com.br', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(15, 'meta_title', 'Omnia Brasil - Soluções para Agricultura', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(16, 'meta_keywords', 'agricultura, fertilizantes, sustentabilidade, omnia', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(17, 'meta_description', 'A Omnia Brasil oferece soluções inovadoras e sustentáveis para a agricultura brasileira.', '2025-05-31 13:56:56', '2025-05-31 13:56:56'),
(18, 'company_slogan', NULL, '2025-06-01 01:48:29', '2025-06-01 01:48:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$ZXlqcEs3NldFU0JoTmNoVQ$Q70bqBOeeVNgPXV3JFHe2tx/iHOiXPSnJ48gDtYqP0Q', 'admin@omnia.com.br', 'Administrador', '2025-05-31 13:56:56', '2025-06-01 04:03:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `temperatura` varchar(10) NOT NULL,
  `icone` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `weather`
--

INSERT INTO `weather` (`id`, `cidade`, `estado`, `temperatura`, `icone`, `updated_at`) VALUES
(1, 'São Paulo', 'SP', '22°C', 'fa-sun', '2025-05-31 13:56:56'),
(2, 'Ribeirão Preto', 'SP', '28°C', 'fa-cloud-sun', '2025-05-31 13:56:56'),
(3, 'Goiânia', 'GO', '30°C', 'fa-sun', '2025-05-31 13:56:56'),
(4, 'Cuiabá', 'MT', '32°C', 'fa-sun', '2025-05-31 13:56:56'),
(5, 'Campo Grande', 'MS', '29°C', 'fa-cloud-sun', '2025-05-31 13:56:56');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `content_sections`
--
ALTER TABLE `content_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_section` (`page_id`,`section_key`);

--
-- Índices de tabela `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Índices de tabela `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Índices de tabela `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `content_sections`
--
ALTER TABLE `content_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `content_sections`
--
ALTER TABLE `content_sections`
  ADD CONSTRAINT `content_sections_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
